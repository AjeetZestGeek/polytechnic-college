<?php
session_start();
session_unset();
session_destroy();
echo"<script>alert('LogedOut successfully');document.location='../../index.php';</script>";