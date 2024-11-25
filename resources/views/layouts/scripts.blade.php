<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('assets/js/bundle/apexcharts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/bundle/select2.bundle.js') }}"></script>
<script src="{{ asset('assets/js/bundle/sweetalert2.bundle.js') }}"></script>
<script src="{{ asset('assets/js/bundle/dataTables.bundle.js') }}"></script>
<script src="{{ asset('assets/summernote/summernote-lite.min.js') }}"></script>
<script src="{{ asset('assets/js/bundle/rating.bundle.js') }}"></script>
<script src="{{ asset('assets/js/bundle/bootstrapdatepicker.bundle.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.33/jquery.colorbox-min.js"></script>
<script src="{{ asset('assets/js/bundle/bootstraptagsinput.bundle.js') }}"></script>
<script src="{{ asset('assets/js/bundle/sweetalert2.bundle.js') }}"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    function isNumberKey(evt){
        if(evt.target.maxLength > 0){
            if(evt.target.value.length > evt.target.maxLength)
            return false;
        }
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if(charCode > 31 && (charCode < 48 || charCode > 57) && charCode==46) {
            return true;
        }
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>