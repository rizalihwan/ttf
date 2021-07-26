{{-- alert success --}}
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <ul>
            <li>{{ session()->get('success') }}</li>
        </ul>
    </div>
@endif
{{-- alert error --}}
@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <ul>
            <li>{{ session()->get('error') }}</li>
        </ul>
    </div>
@endif
