# PHP_PCshoppingmall_MVC

PHP기반 MVC패턴 PC 쇼핑몰</br>
ショッピングモールメカニズムを理解して開発したコンピューターショッピングモール</br>

<b>1.概要</b></br>
MVC패턴(Model, View, Controller)과 PHP문법, 서버의 동작방식 등을 익히고 MVC패턴의 PHP기반 개인 쇼핑몰을 개발한다. 개발해 나가면서 전체적인 MVC패턴의 흐름을 확실히 익히고, PHP의 동작 방식에 대해서 확실히 이해한다. 또한 평소에 이용하던 쇼핑몰과 웹사이트들의 동작방식과 전체적인 메카니즘을 이해하게 되며, 기존에 나와있는 MVC, PHP 문법 기술들의 개선방안을 생각하여 적용하고, 쇼핑몰에 적용하면 개선될 수 있는 기술(반응형, 프레임워크 등)을 찾아 적용하고 새로운 자신만의 쇼핑몰을 만들어 나간다. 

<b>2.主な機能</b></br>
*PHP&HTML</br>
  관리자가 로그인시 일반모드/관리자모드 변경가능, 관리자모드의 회원관리(회원정보 수정 삭제), 상품관리(상품등록(이미지),삭제)</br>
  메뉴에 따른 서브메뉴와 상품출력, 회원로그인/로그아웃, 회원정보검색기능, 상품 등록/보기, 상품상세보기, 게시판의 페이지네이션,</br> 커뮤니티(게시판) 댓글작성, 답글작성(수정삭제), 쇼핑몰 회원의 레벨별 기능 설정, 회원의 닉네임 설정</br>
*CSS&BOOTSTRAP</br>
  쇼핑몰 전체 디자인관리(반응형 테이블 형태,색상,버튼 등), 물품이미지의 반응형 이미지, 웹브라우저 크기에 따른 쇼핑몰 반응형 크기</br>
*JavaScript&AngularJS</br>
  부드러운 맨위로 버튼(JS), 로그인시 간략하게 회원정보보기(AJS)</br>

<b>3.開発環境</b>: SublimeText3, XAMPP</br>
<b>4.開発言語</b> : MySQL 5.6.26, PHP 5.6.12, Apache 2.4.16, AnguralJS, Bootstrap, JavaScript, MVC pattern</br>


# database architecture
![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/database_architecture.png)</br>
<b>membership</b></br>
	member_id(Primary key) : 회원의 고유한 회원번호</br>
	passwd : 회원 id에 일치하는 비밀번호</br>
	level : 회원의 레벨에 따른 조작 가능한 기능을 제한 하기위한 레벨</br>
<b>product</b></br>
	pnum(Primary key) : 각 물품의 고유한 물품번호</br>
	pcategory : 물품의 목록을 보여줄 때 기준이되는 물품 카테고리</br>
	pfimage : 물품의 풀 이미지</br>
	psimage : 물품의 썸네일 이미지</br>
<b>freeboard</b></br>
	fnum(Primary key) : 커뮤니티 게시판 게시글의 고유한 게시글번호</br>
	mnum(foreign key) : 게시글을 작성한 회원의 고유 회원번호</br>
	ishtml : 게시글의 html태그 사용 여부 체크</br>
	family : 답글와 본글의 그룹을 맺어주기위한 그룹 고유번호</br>
	orderby : 답글과 본글의 순서를 정렬해주기위한 번호</br>
	step : 본글의 답글인지 답글의 답글인지를 알기위한 번호</br>
<b>free_attach</b></br>
	anum(Primary key) : 게시글의 첨부한 파일의 고유 번호</br>
	ptnum(foreign key) : 첨부파일이 포함된 게시글의 번호를 담음</br>
<b>free_reply</b></br>
	rnum(Primary key) : 댓글의 고유 번호</br>
	ptnum(foreign key) : 댓글이 작성된 게시글의 번호</br>
	mnum(foreign key) : 댓글을 작성한 회원번호</br>
	
#説明
<b>전체적인 쇼핑몰 실행화면</b></br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname01.bmp)</br>
<b>1.로그인&관리자모드</b></br>
	1-1)로그인화면</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname02.bmp)</br>
	1-2)일반회원과 관리자가 로그인시 아이디와 레벨 표시</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname03.bmp)</br>
	1-3)로그인시 로그아웃 알림</br>		![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname04.bmp)</br>
	1-4)관리자로그인시 ManageMode(관리자모드) <-> PublicMode(일반모드) 변경버튼 생성</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname05.bmp)</br>
	1-4-1)관리자로그인 중 일반모드</br>
	일반회원과 같은 뷰 출력</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname06.bmp)</br>
	1-4-2) 관리자로그인 중 관리자모드</br>
	쇼핑몰을 관리하기위한 뷰 출력</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname07.bmp)</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname08.bmp)</br>

</br>
<b>2.관리자모드 삭제</b></br>
	2-1)회원관리, 물품관리시 한번에 삭제할 수 있는 기능(체크박스)</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname09.bmp)</br>
<b>3.게시판(커뮤니티)</b></br>
	3-1)답글형게시판</br>
	3-1-1) 본글에 대한 답글, 답글에 대한 답글 입력, 삭제 정렬</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname10.bmp)</br>	
	3-1-3)답글에 대한 답글 입력</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname11.bmp)</br>
	3-2)댓글형게시판 </br>
	3-2-1) 본글/답글에 대한 댓글 입력(로그인시),출력</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname12.bmp)</br>
</br>
<b>4.추가 편의기능</b></br>
	4-1) 로그인시 간략한 프로필보기기능(AnguralJS사용)</br>
![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname13.bmp)</br>
	4-2) 회원가입시 회원의 다양한 정보 입력</br>
![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname14.bmp)</br>
	4-3) 스크롤 시에도 고정적인 메뉴</br>
	4-3-1)스크롤 상단</br>
![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname15.bmp)</br>
	4-3-2)스크롤 하단 & 하단 우측의 맨위로 버튼을 누르면 부드럽게 상단으로 이동</br>
![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname16.bmp)</br>
	4-4)화면크기에 대한 반응형 웹사이트</br>
	4-4-1)풀사이즈</br>
![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname17.bmp)</br>
	4-4-2)풀사이즈 이하 사이즈(이미지, 글자 크기 축소)</br>
![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname18.bmp)</br>
	4-5)회원정보 찾기(다른 기준)</br>
![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname19.bmp)</br>
	</br>
<b>6. 프로젝트 주요 소스코드 캡쳐 및 설명(주요 코드 반드시 캡쳐 하여 첨부)</b></br>
<b>view</b></br>
	6-1)커뮤니티 게시판 리스트</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname20.bmp)</br>
	6-2)본글쓰기</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname21.bmp)</br>
	6-3)글 자세히보기</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname22.bmp)</br>
	6-3-1) 답글쓰기</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname23.bmp)</br>
	6-4)답글쓰기</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname24.bmp)</br>
<b>controll</b></br>
	6-1)글쓰기(본글 답글) 저장</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname25.bmp)</br>
<b>model</b></br>
	6-1)게시글 상세보기(댓글포함)</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname26.bmp)</br>
	6-2)본글작성</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname27.bmp)</br>
	6-3)답글작성</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname28.bmp)</br>
