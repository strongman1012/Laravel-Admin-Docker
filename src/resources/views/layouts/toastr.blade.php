@if(session('flash_message'))
<script>
    $(function(){

        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-top-full-width",
        }

        toastr.success('{{session("flash_message")}}');
    });
</script>
@endif