@extends('bar')

@section('content')
<style>

.chat-container {
    width: 100%;
    max-width: 600px;
    margin: auto;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    height: 500px;
    overflow-y: auto;
}

.message {
    padding: 10px 20px;
    border-radius: 20px;
    margin: 10px 0;
    max-width: 70%;
}

.left {
    background-color: #d1e7ff;
    align-self: start;
    margin-right: auto;
}

.right {
    background-color: #c8f7c5;
    align-self: end;
    margin-left: auto;
}

.text-input {
    display: flex;
    padding: 20px;
    position:relative;
    top:250px
}

.text-input input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 20px;
    margin-right: 10px;
}

.text-input button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 20px;
}


</style>
<form action="{{ route('message.insert', $user->id) }}" method="POST">
    @csrf
    <div class="chat-container">
        @foreach($messages as $message)
            <div class="message {{ $message->my_id == Auth::user()->id ? 'right' : 'left' }}">
                {{ $message->text }} - {{ $message->my_id == Auth::user()->id ? 'You' : 'Other' }}
            </div>
        @endforeach
        <div class="text-input">
            <input type="text" name="message" placeholder="Type a message...">
            <button type="submit">Send</button>
        </div>
    </div>
</form>
@endsection
