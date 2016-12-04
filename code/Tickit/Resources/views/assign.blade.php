@extends('tickit::layouts')

@section('content')
    <h1 class="title is-1">Assign member to user story #{{ $userStoryId }}</h1>

    <form method="POST">
        {{ csrf_field() }}

        <label class="label">Select member</label>
        <p class="control">
        <span class="select">
            <select name="member_id">
                @foreach($members as $member)
                    <option value="{{ $member->getId() }}">
                        {{ $member->getFullName() }}
                    </option>
                @endforeach

                <option>With options</option>
            </select>
        </span>
        </p>

        <p class="control">
            <button class="button is-success">Assign to user story</button>
            <a class="button is-light" href="{{ route('home') }}">Cancel</a>
        </p>
    </form>
@endsection