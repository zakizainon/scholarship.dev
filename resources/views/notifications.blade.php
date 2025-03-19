<script type="text/javascript">
      
    @session("success")
        toastr.success("{{ $value }}", "YTI Scholarship");
    @endsession
  
    @session("info")
        toastr.info("{{ $value }}", "YTI Scholarship");
    @endsession
  
    @session("warning")
        toastr.warning("{{ $value }}", "YTI Scholarship");
    @endsession

    @session("error")
        toastr.error("{{ $value }}", "YTI Scholarship");
    @endsession
  
</script>