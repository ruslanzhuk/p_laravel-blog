@extends('layouts.main')

@section('content')
    <h1>{{ $title }}</h1>

    <table border="2">

        @foreach($users as $user)
            @if($a == 0)
                <tr style="border: 2px solid black">
                    @foreach($user as $key => $value)
                        <td style="padding: 3px 6px">{{ $key }}</td>
                    @endforeach
                </tr>
                    <?php $a++; ?>
            @endif
            <tr style="border: 2px solid black">
                @foreach($user as $field)
                    <td style="padding: 3px 6px">{{ $field }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>
@endsection
