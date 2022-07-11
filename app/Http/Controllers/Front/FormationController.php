<?php

namespace App\Http\Controllers\Front;

use FFMpeg\FFMpeg;

use FFMpeg\FFProbe;
use App\Models\Panier;
use App\Models\Categorie;
use App\Models\Formation;
use App\Models\Discussion;
use App\Models\Application;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FormationController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formations = Formation::with(['user'])->paginate(15);
        $categories = Categorie::paginate(13);

        return view('front.formations.index', [
            'formations' => $formations,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::get();

        return view('front.formations.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator($request->all(), [
            'nom' => ['required', 'string', 'max:255', 'unique:formations'],
            'description' => ['required', 'string'],
            'prix' => 'numeric',
            'photo_url' => 'required|mimes:jpg,jpeg,png,bmp,gif,svg|max:4048',
            'categories' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->route('MesFormations')->with('error', $validation->errors()->all());
        } else {
            $formation = Formation::create([
                'nom' => $request->nom,
                'description' => $request->description,
                'prix' => $request->prix,
                'photo_url' => $request->file('photo_url')->storeAs('img/ImagesFormations', $request->file('photo_url')->getClientOriginalName()),
                'user_id' => auth()->user()->id,
                'slug' => Str::slug($request->nom, "-")
            ]);

            $formation->categories()->sync($request->categories, []);

            return redirect()->route('MesFormations')->with('status', 'formation crée');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Formation $formation)
    {
        $formation->load('categories', 'episodes', 'user', 'chapitres.tests');

        $plus_visites = Formation::with(['categories', 'chapitres', 'episodes'])->take(3)->get();
        $nouveautes = Formation::with(['categories', 'chapitres', 'episodes'])->latest()->take(3)->get();


        $viewed = Session::get('viewed_formation', []);
        if (!in_array($formation->id, $viewed)) {
            $formation->increment('view_count');
            Session::push('viewed_formation', $formation->id);
        }

        $categories = Categorie::paginate(5);

        $discussions = Discussion::take(3)->get();
        $categories = Categorie::paginate(15);
        $total = 0;

        $ratings = DB::select('select * from ratings where formation_id = ?', [$formation->id]);

        $rating_count = count($ratings);

        if ($rating_count == 0)
            $avg_rating = 0;
        else {
            foreach ($ratings as $key => $value) {
                $total += $value->value;
            }
            $avg_rating = $total / $rating_count;
        }

        return view('front.formations.show', [
            'formation' => $formation,
            'plus_visites' => $plus_visites,
            'nouveautes' => $nouveautes,
            'categories' => $categories,
            'discussions' => $discussions,
            'rating_count' => $rating_count,
            'avg_rating' => $avg_rating
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Formation $formation)
    {
        $categories = Categorie::get();

        return view('front.formations.edit', [
            'formation' => $formation,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formation $formation)
    {
        if ($request->hasFile('photo_url')) {
            $request->validate([
                'photo_url' => 'required|mimes:jpg,jpeg,png,bmp,gif,svg|max:4048',
            ]);

            $photo_url = $request->file('photo_url')->storeAs('img/ImagesFormations', $request->file('photo_url')->getClientOriginalName());
            $formation->photo_url = $photo_url;
        }

        $formation->nom = $request->nom;
        $formation->description = $request->description;
        $formation->prix = $request->prix;

        $formation->save();

        $formation->categories()->sync($request->input('categories'));

        return redirect()->route('MesFormations')->with('status', 'formation modifiée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formation $formation)
    {
        $formation->delete();

        return redirect()->route('MesFormations')->with('status', 'formation supprimée');
    }

    public function cart()
    {
        return view('front.payement.payement');
    }
    public function addToCart(Formation $formation)
    {
        $id = $formation->id;

        if (!$formation) {

            abort(404);
        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if (!$cart) {

            $cart = [
                $id => [
                    "nom" => $formation->nom,
                    "prix" => $formation->prix,
                    "photo" => $formation->photo_url
                ]
            ];

            session()->put('cart', $cart);

            if (auth()->check()) {
                Panier::create([
                    'donnees_panier' => $cart,
                    'user_id' => auth()->user()->id
                ]);
            }

            return redirect()->back()->with('status', 'Formation ajoutée au panier');
        }


        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "nom" => $formation->nom,
            "prix" => $formation->prix,
            "photo" => $formation->photo_url
        ];

        session()->put('cart', $cart);

        if (auth()->check()) {
            $panier = Panier::where('user_id', auth()->user()->id)->get()[0];

            $panier->donnees_panier = $cart;
            $panier->save();
        }

        return redirect()->back()->with('status', 'Formation ajoutée au panier');
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {

            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);

                if (auth()->check()) {
                    $panier = Panier::where('user_id', auth()->user()->id)->get()[0];

                    $panier->donnees_panier = $cart;
                    $panier->save();
                }
            }

            $total = $this->getCartTotal();

            return response()->json(['msg' => 'Formation supprimée du panier', 'total' => $total]);
        }
    }

    public function clearCart()
    {
        session()->forget('cart');

        if (auth()->check())
            DB::delete('delete from paniers where user_id = ?', [auth()->user()->id]);

        return response()->json(['msg' => 'Cart cleared']);
    }

    /**
     * getCartTotal
     *
     *
     * @return float|int
     */
    private function getCartTotal()
    {
        $total = 0;

        $cart = session()->get('cart');

        foreach ($cart as $id => $details) {
            $total += $details['prix'];
        }

        return number_format($total, 2);
    }

    public function MonApprentissage()
    {
        $categories = Categorie::paginate(8);

        $temp = [];
        foreach (auth()->user()->payements as $payement) {
            array_push($temp, $payement['formation_id']);
        }

        $formations = Formation::paginate(9);

        foreach ($formations as $key => $formation) {
            if (!in_array($formation->id, $temp)) {
                $formations->forget($key);
            }
        }

        return view('front.apprentissage', [
            'formations' => $formations,
            'categories' => $categories
        ]);
    }

    public function MesFormations()
    {
        $formations = auth()->user()->formations()->paginate(8);
        $categories = Categorie::paginate(5);

        return view('front.mes-formations', [
            'formations' => $formations,
            'categories' => $categories
        ]);
    }
}
