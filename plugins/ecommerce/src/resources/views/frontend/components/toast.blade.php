@if(session()->has('toast_notification'))
<div id="toast" class="{{ session('toast_notification')['type'] }}">
    <div id="icon-wrapper">
        <div id="icon"></div>
    </div>
    <div id="toast-message">
        <h4>{{ session('toast_notification')['title'] }}</h4>
        <p>{{ session('toast_notification')['message'] }}</p>
    </div>
    <button id="toast-close"></button>
    <div id="timer"></div>
</div>
@endif