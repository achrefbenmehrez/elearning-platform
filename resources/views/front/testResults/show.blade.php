<x-app-layout>

    <div class="container">
        <div class="card mb-4 mt-4">
            <div class="card-body">
            <h5 class="card-title mb-4 mt-4 d-flex justify-content-center">Resultats du test {{ $test->title }}</h5>

            <table class="table-sm d-flex d-flex justify-content-center">
                <tbody>
                    <tr>
                      <th>Nombre de questions</th>
                        <td>{{ $testResult->question_number }}</td>
                    </tr>
                    <tr>
                      <th>Attempt</th>
                        <td>{{ $testResult->attempt }}</td>
                    </tr>
                    <tr>
                      <th>Correct</th>
                        <td>{{ $testResult->correct }}</td>
                    </tr>
                    <tr>
                      <th>Faux</th>
                          <td>{{ $testResult->wrong }}</td>
                    </tr>
                    <tr>
                        <th>Pourcentage</th>
                          <td>{{ $testResult->percentage }}%</td>
                    </tr>
                    <tr>
                        <th>Score total</th>
                          <td>{{ $testResult->correct }}/{{ $testResult->wrong+$testResult->correct }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                <a href="{{ route('tests.show', [$formation->slug, $chapitre->id, $test->id]) }}" class="btn btn-primary mb-4 mt-4 ">Refaire le test</a>
            </div>
            </div>
        </div>
    </div>

</x-app-layout>
