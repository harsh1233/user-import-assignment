@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Upload Results</h1>

        @if (count($failedRows) > 0 || count($duplicateRecords) > 0)
            <div class="alert alert-danger">
                @if (count($failedRows) > 0)
                    <h4>{{ count($failedRows) }} rows failed to process:</h4>
                    <ul>
                        @foreach ($failedRows as $failedRow)
                            <li>
                                <strong>Row {{ $failedRow['row'] }}:</strong><br>
                                <ul>
                                    @foreach ($failedRow['errors'] as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if (count($duplicateRecords) > 0)
                    <h4>{{ count($duplicateRecords) }} duplicate records:</h4>
                    <ul>
                        @foreach ($duplicateRecords as $duplicateRecord)
                            <li>
                                <strong>Row {{ $duplicateRecord['row'] }}:</strong><br>
                                <ul>
                                    @foreach ($duplicateRecord['errors'] as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @else
            <div class="alert alert-success">
                All rows were processed successfully.
            </div>
        @endif

    </div>
@endsection
