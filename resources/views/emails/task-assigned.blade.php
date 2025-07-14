<h2>Hello {{ $task->user->name }},</h2>

<p>You’ve been assigned a new task:</p>

<ul>
    <li><strong>Title:</strong> {{ $task->title }}</li>
    <li><strong>Description:</strong> {{ $task->description ?? 'No description' }}</li>
    <li><strong>Deadline:</strong> {{ $task->deadline?->toDayDateTimeString() ?? 'None' }}</li>
</ul>

<p>Status: {{ $task->status }}</p>

<p>Good luck!</p>
