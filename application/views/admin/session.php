<?php
if(getRole()!="admin")
{
	redirect('login');
}
?>