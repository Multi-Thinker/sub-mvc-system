<!DOCTYPE html>
<html>
<head>
	<title>Students CRUD - Talha Habib</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		.log {
  position: absolute;
  bottom: 50px;
  left: 0;
  float: left;
  padding: 30px;
  border: 2px solid lightgrey;
  border-radius: 10px;
  -moz-border-radius: 10px;
  -webkit-border-radius: 10px;
  background: white;
  color: black;
}

.inline {
  width: 100%;
  text-align: center;
  margin: 0 auto;
}

.popup {
  border: 1px solid lightgrey;
  box-shadow: 0px 0px 5px 0px lightgrey;
  border-radius: 5px;
  margin-top: 10px;
  text-align: center;
  position: relative;
}
.popup:before {
  content: "";
  position: absolute;
  width: 0;
  height: 0;
  top: -10px;
  left: 49%;
  outline: 1px black;
  border-bottom: 10px solid lightgrey;
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
}

.editor {
  position: absolute;
  top: 5px;
  left: -30px;
  background: lime;
  color: green;
  border-radius: 50% 0px 0px 50%;
  -moz-border-radius: 50% 0px 0px 50%;
  -webkit-border-radius: 50% 0px 0px 50%;
  margin: 0;
  text-align: center;
  width: 30px;
  height: 40px;
  cursor: pointer;
  box-shadow: -1px 1px 0px 0px lightgrey;
  -webkit-box-shadow: -1px 1px 0px 0px lightgrey;
  -moz-box-shadow: -1px 1px 0px 0px lightgrey;
  display: none;
  border: 0px none;
}
.editor i {
  text-align: center;
  margin: 0 auto;
  margin-left: 5px;
  line-height: 40px;
}
.editor[disabled] {
  background: gray;
  color: black;
}

.resultTable tbody > tr:hover .editor {
  display: block;
}

.hidden {
  display: none;
}

.visible {
  display: block;
}

.notFound {
  width: 100%;
  height: 200px;
  color: grey;
  font-weight: lightest;
  text-align: center;
  border: 2px dashed grey;
}
.notFound h1 {
  line-height: 200px;
  margin: 0 auto;
}

#buttons {
  width: 100%;
  margin: 0 auto;
  text-align: center;
}
#buttons input {
  border: 1px solid lightgrey;
  border-radius: 2px;
  background: white;
}

/** top container **/
.content {
  background: #f5f5f5;
  min-height: 250px;
  border: 1px solid lightgrey;
  border-radius: 5px;
}
.content hr {
  margin-top: 20px;
}

.shelf {
  margin: auto;
  padding: 20px;
  height: 85px;
}
.shelf input[type="text"] {
  max-height: 35px;
  width: 300px;
}
.shelf:last-child {
  padding-top: 10px;
}
.shelf label {
  line-height: 35px;
  width: 70px;
  font-size: 16px;
  margin-right: 20px;
}
.shelf label span {
  color: red;
}

/** bottom container **/
@media (max-width: 450px) {
  table.table-bordered tr,
  table.table-bordered td,
  table.table-bordered th,
  table.table-bordered thead,
  table.table-bordered tbody,
  table.table-bordered {
    display: block;
  }

  table.table-bordered {
    display: flex;
    overflow: hidden;
    border: 0px none;
    width: 100%;
    margin: auto;
  }

  table.table-bordered th {
    border: 0px none;
  }

  table.table-bordered tr {
    margin: 0.2em 0;
  }

  table.table-bordered thead {
    --cols: 6;
    --height: calc(1.67em * var(--cols));
    text-shadow: 0 var(--height), 0 calc(var(--height) * 2), 0 calc(var(--height) * 3), 0 calc(var(--height) * 4);
    /* extra shadows are still ok */
  }

  table.table-bordered th {
    text-align: left;
  }

  table.table-bordered td:not(:first-child) {
    border-top: none;
  }
}
.nopd {
  padding: 0px;
  margin-top: 10px;
}
.nopd .table-bordered {
  border-radius: 5px !important;
  border-spacing: 0;
  border-collapse: collapse;
  position: relative;
}
.nopd .table-bordered tr,
.nopd .table-bordered td {
  white-space: nowrap;
  position: relative;
}
.nopd .table-bordered th {
  cursor: pointer;
}
.nopd .table-bordered .deleteBtn {
  border: 1px solid lightgrey;
  border-radius: 2px;
  width: 100%;
  height: 100%;
  outline: none;
  cursor: pointer;
  background: #fefefe;
  background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIzNiUiIHN0b3AtY29sb3I9IiNmZWZlZmUiIHN0b3Atb3BhY2l0eT0iMSIvPgogICAgPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjYjdiN2I3IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iI2U1ZTVlNSIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgPC9saW5lYXJHcmFkaWVudD4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
  background: -moz-linear-gradient(top, #fefefe 36%, #b7b7b7 100%, #e5e5e5 100%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(36%, #fefefe), color-stop(100%, #b7b7b7), color-stop(100%, #e5e5e5));
  background: -webkit-linear-gradient(top, #fefefe 36%, #b7b7b7 100%, #e5e5e5 100%);
  background: -o-linear-gradient(top, #fefefe 36%, #b7b7b7 100%, #e5e5e5 100%);
  background: -ms-linear-gradient(top, #fefefe 36%, #b7b7b7 100%, #e5e5e5 100%);
  background: linear-gradient(to bottom, #fefefe 36%, #b7b7b7 100%, #e5e5e5 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#fefefe", endColorstr="#e5e5e5", GradientType=0 );
}

	</style>
</head>

<body>


<div class='container content'>
  <form class='shelf'>
    <table>
      <tr>
        <td>
          <label for='title'>Title <span>*</span></label>
        </td>
        <td>
          <input type='text' class='form-control' id='title' name='title' autocomplete="off" required />
          <span style='color:red' class='titleHint hidden'><small>Title field can't be empty</small></span>
        </td>
      </tr>
      <tr>
        <td>
          <label for='author'>Author <span>*</span></label>
        </td>
        <td>
          <input type='text' class='form-control' id='author' name='author' autocomplete="off" required />
          <span style='color:red' class='authorHint hidden'><small>Author field can't be empty</small></span>
          <input type='hidden' name='id' id='id' />
        </td>
      </tr>
    </table>
    <hr>
    <div class='form-group'>
      <label></label>
      <input type='submit' role='button' class='btn btn-primary' name='add' id='add' value='Add'>
      <input type='button' role='button' class='btn btn-danger hidden' name='cancel' id='cancel' value='Cancel'>
    </div>
  </form>
</div>
<div class='container nopd'>
  <div class='tableContainer'>
    <div class='row'>
      <div class='col-md-6 col-sm-6 col-xs-6 col-lg-6'>
      </div>
      <div class='col-md-6 col-sm-6 col-xs-6 col-lg-6'>
        <input type='text' placeholder='search' class='form-control searchTable'>
      </div>
    </div>
    <table class='table table-bordered resultTable' id="resultTable">
      <thead>
        <th class='title_head'>Title <i class='pull-right fa fa-arrow-up hidden'></i></th>
        <th class='author_head'>Author <i class='pull-right fa fa-arrow-up hidden'></i></th>
        <th width='20px'>Delete</th>
      </thead>
      <tbody>
      	<?php 
      	foreach($rows as $k => $record){
      		?>
        <tr data-row='<?=$record->id?>'>
          <td class='title_content'>
            <button class='editor'><i class='fa fa-pencil'></i></button>
            <span class='text'><?=MT_Module::dbOut($record->title)?></span>
          </td>
          <td class='author_content'>
            <span class='text'><?=MT_Module::dbOut($record->author)?></span>
          </td>
          <td><button class='deleteBtn'><i class='fa fa-trash'></i></button>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <div class='notFound hidden'>
    <h1>Books not found</h1>
  </div>
</div>
<div class='log hidden'></div>

<script type="text/javascript">
/**
 * Author: Talha Habib
 * Description: Pure JS skill demonstration
 * Copyright licensed, restricted use without consent and credits. 
 * Dated: AUGUST 01, 2018
 * git: https://github.com/Multi-Thinker/bookrecord/
 */
var index = []; // cell index
var token = '<?=$csrf?>';
(function() {
  var titleIN = document.querySelector("#title");
  var authorIN = document.querySelector("#author");
  var idIN = document.querySelector("#id");
  var subBtn = document.querySelector("#add");
  var canBtn = document.querySelector("#cancel");
  var titleHint = document.querySelector(".titleHint");
  var authorHint = document.querySelector(".authorHint");
  var deleteBtn = document.querySelectorAll(".deleteBtn");
  var notFound = document.querySelector(".notFound");
  var table = document.querySelector(".resultTable");
  var editorBtn = document.querySelectorAll(".editor");
  // var pop = document.querySelector(".pop");
  var popup = document.querySelector(".popup");
  var tbody = table.querySelector("tbody");
  var tds = tbody.querySelectorAll("td");
  var lastTr = tbody.querySelectorAll("tr");
  var lastID = 1;
  if (lastTr.length > 0) {
    lastID = lastTr[lastTr.length - 1].getAttribute("data-row");
  }
  var searchInput = document.querySelector(".searchTable");
  /** search table **/
  searchInput.addEventListener("keyup", function() {
    var tds = tbody.querySelectorAll("td");
    var inputVal = this.value.toLowerCase();
    addClasses(table, "td", "hidden");
    if (inputVal.length > 0) {
        Array.from(tds).forEach(function(elem, key) {
        if (elem.textContent.toLowerCase().includes(inputVal))
          elem.parentNode.classList.remove("hidden");
      });
    } else {
      removeClasses(table, "td", "hidden");
    }
  });
  /** sorting**/
  var toggleBool; // sorting asc, desc
  function sorting(tbody, index, elem) {
    if(tbody.rows.length<=1){
      return false;
    }
    var icon = elem.querySelector("i").classList;
    var icons = table.querySelectorAll("th i");
    Array.from(icons).forEach(function(el) {
      el.classList.add("hidden");
    });
    elem.querySelector("i").classList.remove("hidden");

    if (this.index[index]) {
      toggleBool = false;
      icon.remove("fa-arrow-down");
      icon.add("fa-arrow-up");
    } else {
      toggleBool = true;
      icon.remove("fa-arrow-up");
      icon.add("fa-arrow-down");
    }

    this.index[index] = toggleBool;
    var datas = new Array();
    var tbodyLength = tbody.rows.length;
    for (var i = 0; i < tbodyLength; i++) {
      datas[i] = tbody.rows[i];
    }
    var oldDatas = toCell(datas, index);

    // sort by cell[index]
    datas.sort(function(a, b) {
      return compareCells(a, b, index);
    });
    var newDatas = toCell(datas, index);
    if (diff(newDatas, oldDatas) == false) {
      sorting(tbody, index, elem);
      return false;
    }

    for (var i = 0; i < tbody.rows.length; i++) {
      // rearrange table rows by sorted rows
      tbody.appendChild(datas[i]);
    }
  }

  var title_head = document.querySelector(".title_head");
  var author_head = document.querySelector(".author_head");
  /** sorting title**/
  title_head.addEventListener("click", function() {
    sorting(tbody, 0, this);
  });
  /** sorting author **/
  author_head.addEventListener("click", function() {
    sorting(tbody, 1, this);
  });

  
  /** validation **/
  
  titleIN.addEventListener("blur", function() {
      titleHintF();
  });
  authorIN.addEventListener("blur", function() {
      authorHintF();
  });
  //** submit **/
  subBtn.addEventListener("click", function(e) {
    e.stopPropagation();
    e.preventDefault();
    var title = htmlEntities(titleIN.value);
    var author = htmlEntities(authorIN.value);
    titleHintF();
    authorHintF();
    if (title == "" || author == "") {
      return false;
    }
    var btn = '<button class="deleteBtn"><i class="fa fa-trash"></i></button>';
    if (idIN.value == "") {
      // insert
      lastID++;
      var Xstatus = ajax("<?=$ci?>/add","title="+encodeURIComponent(title)+"&author="+encodeURIComponent(author));
      lockform();
      logging("adding new book...");
      lockEdit();
      Xstatus.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          appendHTML(
            tbody,
            "<tr data-row='" +
              this.responseText +
              "'><td class='title_content'><button class='editor'><i class='fa fa-pencil'></i></button><span class='text'>" +
              title +
              "</span></td><td class='author_content'><span class='text'>" +
              author +
              "</span></td><td>" +
              btn +
              "</td></tr>"
          );
          lastID = this.responseText;
          logging("new book added");
          registerEdit();
          registerDel();
        }else{
          logging("error in adding new book");
        }
        unlockForm();
      };
    } else {
      lockform();
      var tlastID = htmlEntities(idIN.value);
      var trow = tbody.querySelector("tr[data-row='" + tlastID + "']");
      var ttcon = trow.querySelector(".title_content");
      var tauh = trow.querySelector(".author_content");
      var Xstatus = ajax("<?=$ci?>/update","title="+encodeURIComponent(title)+"&author="+encodeURIComponent(author)+"&id="+tlastID);
      logging("updating book...");
      Xstatus.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          ttcon.querySelector(".text").innerHTML = title;
          tauh.querySelector(".text").innerHTML = author;
          logging("book updated");
        }else{
          logging("error in updating books");
        }
        unlockForm();
      };
    }
  });
  /** cancel btn **/
  canBtn.addEventListener("click", function() {
    unlockEdit();
    clear();
  });
  /** download btn **/
  // pop.addEventListener("click", function() {
  //   popup.classList.toggle("hidden");
  // });
  /** functions **/
  /** editing **/
  function registerEdit() {
    var editorBtn = document.querySelectorAll(".editor");
    Array.from(editorBtn).forEach(function(elem) {
      elem.addEventListener("click", function() {
        clearWarn();
        lockEdit();        
        canBtn.classList.remove("hidden");
        var row = this.parentNode.parentNode;
        var title = row.querySelector(".title_content").textContent;
        var author = row.querySelector(".author_content").textContent;
        var id = row.getAttribute("data-row");
        idIN.value = id;
        titleIN.value = title.trim();
        authorIN.value = author.trim();
        subBtn.value = "Update";
      });
    });
  }
  registerEdit();
  /** deleting **/
  function registerDel() {
    var deleteBtn = document.querySelectorAll(".deleteBtn");
    Array.from(deleteBtn).forEach(function(el) {
      el.addEventListener("click", function() {
        lockDelete();
        var id = this.parentNode.parentNode.getAttribute("data-row");
        logging("deleting book...");
        var xSend = ajax("<?=$ci?>/delete","id="+id);
        var thisBtnRow = this.parentNode.parentNode;
        xSend.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            thisBtnRow.remove();
            checkEmptyTable();
            logging("book deleted");
          }else{
            logging("error in deleting book");
          }
          unlockDelete();
        };
      });
    });
  }
  registerDel();
  function logging(string){
    var log = document.querySelector(".log");
    log.innerHTML = string;
    log.classList.remove("hidden");
    setTimeout(function(){
      log.classList.add("hidden");
    },1000);
  }
  function ajax(url,query){
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", url, true);
        xhttp.setRequestHeader("X-CSRF-TOKEN", token);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query+"&_token="+token);
        return xhttp;
  }
  function lockform(){
    lockEdit();
    lockInsert();
  }
  function unlockForm(){
    clear();
    unlockEdit();
    unlockInsert();
  }
  function lockEdit(){
    var editorBtn = document.querySelectorAll(".editor");
    Array.from(editorBtn).forEach(function(elem){
      elem.setAttribute("disabled","disabled");
    });
  }
  function lockDelete(){
    var deleteBtn = document.querySelectorAll(".deleteBtn");
    Array.from(deleteBtn).forEach(function(elem){
      elem.setAttribute("disabled","disabled");
    });
  }
  function lockInsert(){
    subBtn.setAttribute("disabled","disabled");
    canBtn.setAttribute("disabled","disabled");
    titleIN.setAttribute("disabled","disabled");
    authorIN.setAttribute("disabled","disabled");
    idIN.setAttribute("disabled","disabled");
  }
  function unlockEdit(){
    var editorBtn = document.querySelectorAll(".editor");
    Array.from(editorBtn).forEach(function(elem){
      elem.removeAttribute("disabled");
    });
  }
  function unlockDelete(){
    var deleteBtn = document.querySelectorAll(".deleteBtn");
    Array.from(deleteBtn).forEach(function(elem){
      elem.removeAttribute("disabled");
    });
  }
  function unlockInsert(){
    subBtn.removeAttribute("disabled");
    canBtn.removeAttribute("disabled");
    titleIN.removeAttribute("disabled");
    authorIN.removeAttribute("disabled");
    idIN.removeAttribute("disabled");
  }
  function titleHintF() {
    var title = titleIN.value;
    if (title == "") {
      titleHint.classList.remove("hidden");
      subBtn.setAttribute("disabled", "disabled");
      subBtn.classList.add("disabled");
      return false;
    } else {
      titleHint.classList.add("hidden");
      subBtn.removeAttribute("disabled");
      subBtn.classList.remove("disabled");
    }
  }
  function authorHintF() {
    var author = authorIN.value;
    if (author == "") {
      authorHint.classList.remove("hidden");
      subBtn.setAttribute("disabled", "disabled");
      subBtn.classList.add("disabled");
      return false;
    } else {
      authorHint.classList.add("hidden");
      subBtn.removeAttribute("disabled");
      subBtn.classList.remove("disabled");
    }
  }
  function htmlEntities(e) {
    return String(e)
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;");
  }
  function clearWarn(){
      titleHint.classList.add("hidden");
      authorHint.classList.add("hidden");
  }
  function clear() {
    titleIN.value = "";
    authorIN.value = "";
    idIN.value = "";
    subBtn.value = "Add";
    canBtn.classList.add("hidden");
    clearWarn();
  }
  function addClasses(parent, elem, cls) {
    Array.from(parent.querySelectorAll(elem)).forEach(function(elem, key) {
      elem.parentNode.classList.add(cls);
    });
  }
  function removeClasses(parent, elem, cls) {
    Array.from(parent.querySelectorAll(elem)).forEach(function(elem, key) {
      elem.parentNode.classList.remove(cls);
    });
  }
  function toCell(datas, index) {
    var arr = [];
    Array.from(datas).forEach(function(val) {
      arr.push(val.cells[index].innerText);
    });
    return arr;
  }
  function diff(newDatas, oldDatas) {
    var difference = false;
    for (var j = 0; j < oldDatas.length; j++) {
      if (newDatas[j] != oldDatas[j]) {
        difference = true;
        break;
      }
    }
    return difference;
  }
  function compareCells(a, b, index) {
    var aVal = a.cells[index].innerText;
    var bVal = b.cells[index].innerText;

    aVal = aVal.replace(/\,/g, "");
    bVal = bVal.replace(/\,/g, "");

    if (toggleBool) {
      var temp = aVal;
      aVal = bVal;
      bVal = temp;
    }

    if (aVal.match(/^[0-9]+$/) && bVal.match(/^[0-9]+$/)) {
      return parseInt(aVal) - parseInt(bVal);
    } else {
      if (aVal < bVal) {
        return -1;
      } else if (aVal > bVal) {
        return 1;
      } else {
        return 0;
      }
    }
  }
  function checkEmptyTable() {
    var tr = tbody.querySelectorAll("tr").length;
    if (tr <= 0) {
      table.parentNode.classList.add("hidden");
      notFound.classList.remove("hidden");
    } else {
      table.parentNode.classList.remove("hidden");
      notFound.classList.add("hidden");
    }
  }
  checkEmptyTable();
  // easy append function
  function appendHTML(element, html) {
    var t = parseHTML(html);
    var trs = element.querySelectorAll("tr").length;
    if (trs > 0) {
      element.insertBefore(t, element.lastElementChild.nextSibling);
    } else {
      element.insertBefore(t, element.lastChild);
      checkEmptyTable();
    }
  }
  function parseHTML(html) {
    var t = document.createElement("template");
    t.innerHTML = html;
    return t.content.cloneNode(true);
  }
})();
</script>
</body>
</html>