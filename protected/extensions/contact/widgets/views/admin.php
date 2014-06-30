 <h1 style  ="margin-left:450px;margin-bottom:20px;">Сообщения</h1>
<table class = "table table-striped">
  <thead>
    <tr>
      <th>ИМЯ</th>
      <th>ТЕЛЕФОН</th>
      <th>ПОЧТА</th>
      <th>ТЕМА</th>
      <th style = "text-align:center">СООБЩЕНИЕ</th>
      <th>УДАЛИТЬ</th>
    </tr>
  </thead>
 <?php 

 foreach($mails as $letter) {
    echo '<tr>';
      echo '<td style = "width:100px;">'.$letter->firstname.'</td>';
      echo '<td style = "width:100px;">'.$letter->phone.'</td>';
      echo '<td style = "width:100px;">'.$letter->email.'</td>';
      echo '<td style = "width:100px;">'.$letter->topic.'</td>';
      echo '<td style = "width:750px;text-align:center">'.$letter->message.'</td>';
      echo '<td style = "text-align:center"><a href = "'.Yii::app()->createUrl('/admin/admin/deleteLetter', array('letter'=>$letter->Id)).'"><i class = "icon-trash"></i></a></td>';
    echo '</tr>';
  }

  ?>  
</table>

  
