<?php use Stationer\Graphite\G; ?>
        <div id="subheader">
            <a href="/LastWord/intro">Intro</a>
            <a href="/LastWord/faq">FAQ</a>
            <a href="/LastWord/list">Password List</a>
<?php if (G::$S->roleTest('LastWord/Admin')) { ?>
            <a href="/LastWord/websites">LastWord Admin</a>
<?php } ?>
        </div>
