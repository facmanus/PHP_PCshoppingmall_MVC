<center>
<?php 
$_SESSION['msg']=isset($_SESSION['msg'])?$_SESSION['msg']:null;

  //비로그인 상태라면
  if(empty($_SESSION['login_seccess_id'])){
  echo($_SESSION['msg']);
  //로그인창을 출력
?>

<form class="form-inline" role="form" name="mem_form" method="post" action="../controller/MainCTL.php?action=912">
<div class="form-group">
  <label for="ID">ID</label>
  <input type="text" class="form-control" id="ID" name="login_id">
</div>
<div class="form-group">
  <label for="pwd">Password:</label>
  <input type="password" class="form-control" id="pwd" name="login_passwd">
</div>
<button type="submit" class="btn btn-default" name ="test" >Login</button>
<a href="../controller/MainCTL.php?action=910" class="btn btn-info" role="button">Join</a>
</form>



<?php }
//로그인 상태라면
else{
    //회원의 정보와 로그아웃, 회원정보변경 등 출력
    echo"<form action = '../controller/MainCTL.php?action=914' method='post'>";
    echo($_SESSION['msg']);
    //관리자이면서 일반모드일떄(관리자 모드가 뜬다.)
    if($_SESSION['login_seccess_level']==99&&intval($action/1000)!=9){
      echo("<a href='../controller/MainCTL.php?action=9100&pageNum=1' class='btn btn-danger'role='button'>Manager Mode</a>");
    }
    //관리자이면서 관리자모드일때(일반 모드가 뜬다.)
      if(intval($action/1000)==9){
        echo("<a href='../controller/MainCTL.php?action=100' class='btn btn-primary'role='button'>Public Mode</a>");
      }
       // 관리자든 일반 유저든 회원정보 수정은 있어야한다.
  ?>
                  <input type='hidden' name='up_member_id' value=<?=$_SESSION['login_seccess_member_id']?> >
                  <input type='submit' value='회원정보변경' class='btn btn-warning' role='button'>
                  <a href="../controller/MainCTL.php?action=913&pageNum=1" class='btn btn-danger'role='button'>Logout</a>
                </form>
<?php
}
?>

</center>