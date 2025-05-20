<div id="isi">

    <div class="judul">
        <h2>Let's Connect with Others!</h2>
    </div>

    <div class="form-wrapper">

        <p id="error-message"></p>
        <!-- kalo ada yg belom keisi, nanti validasinya muncul di sini -->

        <form id="form" action="../php/forum1.php" method="POST">
            <h3>Log In</h3>
            <div>
                
                <label for="email">Email</label>
                <input type="email" name="email" id="email-input" placeholder="Input your e-mail!" required>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password-input" placeholder="Input your password!" required>
            </div>

            <button type="submit" class="btn">Log In</button>

            <div class="popup" id="popup">
                <h2>Congratulations!</h2>
                <p>You have successfully signed up</p>
                <p><a href="forum3" href="forum3.html">Click here to start</a></p>
                <button type="button" onclick="closePopup()">OK</button>
            </div>
        </form>

        <p class="login">Don't have an account? <a href="forum2_revisi.html">Sign Up</a></p>

        <script>
            const popup = document.getElementById("popup");

            function openPopup() {
                const email = document.getElementById("email-input").value.trim();
                const password = document.getElementById("password-input").value.trim();

                if (!email || !password) {
                    alert("Fill out all fields before submitting!");
                } else if (password.length < 8) {
                    alert("At least 8 characters long!");
                } else {
                    popup.classList.add("open-popup");
                    document.getElementById("form").reset();
                }
            }

            function closePopup() {
                popup.classList.remove("open-popup");
                document.getElementById("form").reset();
            }
        </script>
    </div>
</div>