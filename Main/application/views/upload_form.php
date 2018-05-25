<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('upload/upload');?>

<input type="file" name="userfile" size="20"/>

<?=anchor('http://www.mcast.edu.mt/180', 'release forms'); ?> <a href="<?=base_url('/ViewerJS/#../uploads/pdf/Artistic-Work-Release-Form.pdf')?>">Artistic work release form</a>
<a href="<?=base_url('/ViewerJS/#../uploads/pdf/Children-Release-Form.pdf')?>">Children release form</a>
<a href="<?=base_url('/ViewerJS/#../uploads/pdf/Location-Release-Form.pdf')?>">Location release form</a>
<a href="<?=base_url('/ViewerJS/#../uploads/pdf/Talent-Release-Form.pdf')?>">Talent release form</a>

<br>


<br/><br/>

<input type="submit" value="upload"/>

</form>

</body>
</html>
