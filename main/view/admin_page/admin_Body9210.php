
<form name="memberJoin" action="../controller/MainCTL.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="9211">
    카테고리 : <select name="pcategory"  placeholder="상품카테고리">
        <option value="C1">게이밍모니터(C1)</option>
        <option value="C2">WQHD모니터(C2)</option>
        <option value="C3">UHD4K모니터(C3)</option>
        <option value="C4">Curved모니터(C4)</option>
        <option value="C5">CCTV용모니터(C5)</option>
        <option value="S1">게이밍노트북(S1)</option>
        <option value="S2">그래픽노트북(S2)</option>
        <option value="S3">울트라노트북(S3)</option>
        <option value="S4">고사양노트북(S4)</option>
        <option value="S5">2in1(S5)</option>
        <option value="B1">삼성컴퓨터(B1)</option>
        <option value="B2">애플컴퓨터(B2)</option>
        <option value="B3">LG컴퓨터(B3)</option>
        <option value="B4">DELL컴퓨터(B4)</option>
        <option value="B5">MSI컴퓨터(B5)</option>
        <option value="H1">삼성올인원(H1)</option>
        <option value="H2">LG올인원(H2)</option>
        <option value="H3">DELL올인원(H3)</option>
        <option value="H4">Intel올인원(H4)</option>
        <option value="H5">애플올인원(H5)</option>
        <option value="A1">조택미니pc(A1)</option>
        <option value="A2">기가바이트미니pc(A2)</option>
        <option value="A3">인텔미니pc(A3)</option>
        <option value="A4">애플미니pc(A4)</option>
        <option value="A5">MSI미니pc(A5)</option>
    </select>	
    <br/>
    <input type="hidden" name="pcode"  placeholder="상품코드"><br/>
    <input type="text" name="pname"  placeholder="상품명"><br/>
    <input type="text" name="pstock"  placeholder="재고량"><br/>
    <input type="text" name="pprice"  placeholder="상품가격"><br/>
    <input type="file" name="pfimage"><br/>
    <input type="reset" value="취소">
    <input type="submit" value="저장"><br/>
</form>
