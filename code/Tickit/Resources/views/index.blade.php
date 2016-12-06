@extends('tickit::layouts')

@section('content')
    <h1 class="title is-1">User Stories</h1>

    <table class="table is-bordered is-striped is-narrow">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Priority</th>
                <th>Assignee</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($userStories->items() as $userStory)
            <tr>
                <td>{{ $userStory->getId() }}</td>
                <td>{{ $userStory->getName() }}</td>
                <td>{{ $userStory->getPriority() }}</td>
                <td>
                    <a href="assign/{{ $userStory->getId() }}">
                        {{ $userStory->getAssignee()->getFullName() }}
                    </a>
                </td>
            </tr>
        @endforeach
        @unless($userStories->count())
            <tr>
                <td colspan="4">
                    There are no available user stories.
                </td>
            </tr>
        @endunless
        </tbody>
    </table>

        <nav class="pagination">
        <ul>
            @for ($page = 1; $page <= $userStories->getLastPage(); $page++)
                <li>
                    <a class="button {{ $page == $userStories->getCurrentPage() ? 'is-primary' : '' }}" href="?current_page={{ $page }}">
                        {{ $page }}
                    </a>
                </li>
            @endfor
        </ul>
    </nav>
@endsection