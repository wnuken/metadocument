<?php
if(isset($_SESSION["access_token"])){
    unset($_SESSION["access_token"]);
    session_destroy();
}

if(isset($_SESSION["service_token"])){
    unset($_SESSION["service_token"]);
    session_destroy();
}
?>

<script type="text/javascript">
window.location="./";
</script>