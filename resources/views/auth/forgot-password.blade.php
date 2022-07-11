<x-app-layout>
    <div class="wm-form-wrap wm-typography-element">

        <div class="card-body container wm-form-wrap wm-typography-element">

            <div class="mb-3">
                {{ __('messages.forgot-password-text') }}
            </div>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <x-jet-validation-errors class="mb-3" />

            <form method="POST" action="/forgot-password">
                @csrf

                <div class="form-group">
                    <label value="Email" ></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus />
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('messages.forgot-password-button') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
