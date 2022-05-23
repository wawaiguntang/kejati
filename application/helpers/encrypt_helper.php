
<?php
function encrypt($s)
{
    return urlencode(base64_encode($s));
}

function decrypt($s)
{
    return base64_decode(urldecode($s));
}
?>
