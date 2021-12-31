<?php
  echo "<b>";
  system('pwd');
  echo "</b>: ";
  system('find . | wc -l');
  echo " inodes<br />n<b>";
  system('cd ~/public_html; pwd');
  echo "</b>: ";
  system('cd ~/public_html; find . | wc -l');
  echo " inodes<br />n<b>";
  system('cd ~; pwd');
  echo "</b>: ";
  system('cd ~; find . | wc -l');
  echo " inodes";  
?>