@if(session('success'))
    <div role="alert" class="alert alert-success">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <div role="alert" class="alert alert-error alert-outline mb-1">
            <span>{{ $error }}</span>
        </div>
    @endforeach
@endif

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessages = document.querySelectorAll('.alert.alert-success');

            if (successMessages.length > 0) {
                setTimeout(() => {
                    successMessages.forEach(message => {
                        message.style.display = 'none';
                    });
                }, 4000);
            }
        });
    </script>
@endpush
