<div>
    <h1>Time selector</h1>
    {{ date('l', strtotime($selectedDate)) }}
    {{ date('j', strtotime($selectedDate)) }}
</div>