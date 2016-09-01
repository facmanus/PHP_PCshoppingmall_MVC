# PHP_PCshoppingmall_MVC

PHP기반 MVC패턴 PC 쇼핑몰
ショッピングモールメカニズムを理解して開発したコンピューターショッピングモール

1.概要
MVC패턴(Model, View, Controller)과 PHP문법, 서버의 동작방식 등을 익히고 MVC패턴의 PHP기반 개인 쇼핑몰을 개발한다. 개발해 나가면서 전체적인 MVC패턴의 흐름을 확실히 익히고, PHP의 동작 방식에 대해서 확실히 이해한다. 또한 평소에 이용하던 쇼핑몰과 웹사이트들의 동작방식과 전체적인 메카니즘을 이해하게 되며, 기존에 나와있는 MVC, PHP 문법 기술들의 개선방안을 생각하여 적용하고, 쇼핑몰에 적용하면 개선될 수 있는 기술(반응형, 프레임워크 등)을 찾아 적용하고 새로운 자신만의 쇼핑몰을 만들어 나간다. 

2.主な機能
PHP&HTML
  관리자가 로그인시 일반모드/관리자모드 변경가능, 관리자모드의 회원관리(회원정보 수정 삭제), 상품관리(상품등록(이미지),삭제)
  메뉴에 따른 서브메뉴와 상품출력, 회원로그인/로그아웃, 회원정보검색기능, 상품 등록/보기, 상품상세보기, 게시판의 페이지네이션, 커뮤니티(게시판) 댓글작성, 답글작성(수정삭제), 쇼핑몰 회원의 레벨별 기능 설정, 회원의 닉네임 설정
CSS&BOOTSTRAP
  쇼핑몰 전체 디자인관리(반응형 테이블 형태,색상,버튼 등), 물품이미지의 반응형 이미지, 웹브라우저 크기에 따른 쇼핑몰 반응형 크기
JavaScript&AngularJS
  부드러운 맨위로 버튼(JS), 로그인시 간략하게 회원정보보기(AJS)

3.開発環境: SublimeText3, XAMPP
4.開発言語 : MySQL 5.6.26, PHP 5.6.12, Apache 2.4.16, AnguralJS, Bootstrap, JavaScript, MVC pattern


# database architecture
![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/database_architecture.png)
membership
	member_id(Primary key) : 회원의 고유한 회원번호
	passwd : 회원 id에 일치하는 비밀번호
	level : 회원의 레벨에 따른 조작 가능한 기능을 제한 하기위한 레벨
product
	pnum(Primary key) : 각 물품의 고유한 물품번호
	pcategory : 물품의 목록을 보여줄 때 기준이되는 물품 카테고리
	pfimage : 물품의 풀 이미지
	psimage : 물품의 썸네일 이미지
freeboard
	fnum(Primary key) : 커뮤니티 게시판 게시글의 고유한 게시글번호
	mnum(foreign key) : 게시글을 작성한 회원의 고유 회원번호
	ishtml : 게시글의 html태그 사용 여부 체크
	family : 답글와 본글의 그룹을 맺어주기위한 그룹 고유번호
	orderby : 답글과 본글의 순서를 정렬해주기위한 번호
	step : 본글의 답글인지 답글의 답글인지를 알기위한 번호
free_attach
	anum(Primary key) : 게시글의 첨부한 파일의 고유 번호
	ptnum(foreign key) : 첨부파일이 포함된 게시글의 번호를 담음
free_reply
	rnum(Primary key) : 댓글의 고유 번호
	ptnum(foreign key) : 댓글이 작성된 게시글의 번호
	mnum(foreign key) : 댓글을 작성한 회원번호
	
#説明
전체적인 쇼핑몰 실행화면</br>
	![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname01.bmp)
1.로그인&관리자모드
	1-1)로그인화면
		![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname02.bmp)
	1-2)일반회원과 관리자가 로그인시 아이디와 레벨 표시
		![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname03.bmp)

	1-3)로그인시 로그아웃 알림
		![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname04.bmp)
	1-4)관리자로그인시 ManageMode(관리자모드) <-> PublicMode(일반모드) 변경버튼 생성
		![ScreenShot](https://github.com/superblr/PHP_PCshoppingmall_MVC/blob/master/readme_img/noname05.bmp)
	1-4-1)관리자로그인 중 일반모드
일반회원과 같은 뷰 출력

	1-4-2) 관리자로그인 중 관리자모드
쇼핑몰을 관리하기위한 뷰 출력



2.관리자모드 삭제
	2-1)회원관리, 물품관리시 한번에 삭제할 수 있는 기능(체크박스)

3.게시판(커뮤니티)
	3-1)답글형게시판
		3-1-1) 본글에 대한 답글, 답글에 대한 답글 입력, 삭제 정렬

		3-1-3)답글에 대한 답글 입력

	3-2)댓글형게시판 
		3-2-1) 본글/답글에 대한 댓글 입력(로그인시),출력


4.추가 편의기능
	4-1) 로그인시 간략한 프로필보기기능(AnguralJS사용)


		4-2) 회원가입시 회원의 다양한 정보 입력

		4-3) 스크롤 시에도 고정적인 메뉴
			4-3-1)스크롤 상단

			4-3-2)스크롤 하단 & 
			하단 우측의 맨위로 버튼을 누르면 부드럽게 상단으로 이동

		4-4)화면크기에 대한 반응형 웹사이트
			4-4-1)풀사이즈



			4-4-2)풀사이즈 이하 사이즈(이미지, 글자 크기 축소)
			
		4-5)회원정보 찾기(다른 기준)

			
6. 프로젝트 주요 소스코드 캡쳐 및 설명(주요 코드 반드시 캡쳐 하여 첨부)


view




	6-1)커뮤니티 게시판 리스트

	6-2)본글쓰기

	6-3)글 자세히보기


		6-3-1) 답글쓰기

	6-4)답글쓰기



controll
	6-1)글쓰기(본글 답글) 저장


model
	6-1)게시글 상세보기(댓글포함)
	
	6-2)본글작성

	6-3)답글작성
