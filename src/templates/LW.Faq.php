<?php echo $this->render('header'); ?>
    <div class="container -full">
        <div class="contanier col-xl-10">
            <div class="card">
                <div class="card-header">
                    <h3> What is "Last Word"?</h3>
                </div>
                <div class="card-body">

                    <p class="card-text">Last Word is a password management system that works by assigning
                        passwords rather than storing them.  The advantage is that your
                        passwords are not stored anywhere to be found.  The disadvantage
                        is that you cannot choose your own passwords.
                    </p>
                    <h2>How does it work?</h2>
                    <p>Three simple steps:</p>
                    <ul>
                        <li>You provide a list of things you login to, including a
                            Service name and a Username</li>
                        <li>You choose and enter a Master Key (Your Last Password)</li>
                        <li>LastWord performs some one-way hashing on the Service
                            names, Usernames, and Master Key you provided.  The
                            result is a unique and secure password for each listed
                            service.
                    </ul>
                    <p>Because the passwords are generated deterministicly from your
                        information, you can come back and get the same generated
                        passwords by re-entering the same Master Key.
                    </p>
                    <h2>How secure is this, really?</h2>
                    <p>Your passwords are not stored, they are rebuilt on your browser
                        each time you need them.  Your Master Key is not stored, you
                        tell it to LastWord, and it never saves it.  Only your list of
                        usernames is stored, so even if someone stole our entire server
                        they would still not have anyone's passwords. So long as your
                        Master Key is kept secret, your passwords are safe.
                    </p>
                    <h2>What's the deal with those little colorful shapes?</h2>
                    <p>Let's call that a pictohash.  The pictohash is generated from
                        your Master Key alone as a quick visual cue to whether you have
                        entered it as you intended.  Since LastWord does not store your
                        Master Key, this is the only way for us to help you know if you
                        entered the correctly -- if the pictohash looks the same, the
                        Master Key is the same.
                    </p>
                    <h2>What if I want to change a password?</h2>
                    <p>Simple!  Click on the
                        <img src="/^LastWord/images/down.png" alt="down">
                        and <img src="/^LastWord/images/up.png" alt="up">
                        arrows in the "Password #" column to choose a new password. The
                        number specified here is added to the Service name, Username and
                        Master Key when producing your password.  A different number
                        here, means a different password.
                    </p>
                    <h2>What if I want to change my Master Key?</h2>
                    <p>That's fine, just enter a different value in the field next time,
                        then, you'll have to change all your passwords.
                    </p>
                </div>
            </div>
            <div><p><a href="/LastWord/list" class="btn btn-primary float-right" role="button">View your list</a></p>
            </div>
        </div>
    </div>
<?php echo $this->render('footer');
