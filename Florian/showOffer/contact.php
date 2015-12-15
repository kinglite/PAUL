<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include head and header
include($root . "/Paul-flo/template/head.php");
include($root . "/Paul-flo/template/header.php");

//optional
//include($root . "/Paul-flo/template/infobox.php");
//content
?>

<div class="container">
    <h1>DRK: Von Deutschland nach Afghanistan</h1>
    <form>
        <div class="row">
            <div class="six columns">
                <label for="title">Titel</label>
                <input class="u-full-width" type="textfield" value="DRK: Von Deutschland nach Afghanistan" id="title">
            </div>
            <div class="six columns">
                <label for="reason">Grund der Nachricht</label>
                <select class="u-full-width" id="reason">
                    <option value="Option 1">Fragen</option>
                    <option value="Option 2">Probleme</option>
                    <option value="Option 3">Feedback</option>
                </select>
            </div>
        </div>
        <label for="exampleMessage">Message</label>
        <textarea class="u-full-width" placeholder="Ihre Nachricht..." id="exampleMessage"></textarea>
        <label class="example-send-yourself-copy">
            <input type="checkbox">
            <span class="label-body">Eine Kopie an mich selbst senden</span>
        </label>
        <input class="button-primary" type="submit" value="Absenden">
    </form>
</div>

<?php
include($root . "/Paul-flo/template/footer.php");
?>