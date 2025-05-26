<div id="isi">

    <div class="judul">
        <h2>Let's Connect with Others!</h2>
    </div>

    <div class="form-wrapper">

        <p id="error-message"></p>
        <!-- kalo ada yg belom keisi, nanti validasinya muncul di sini -->

        <form id="form" action="../A_Controller/signup2_controller.php" method="post" enctype="multipart/form-data">

            <h3>Sign Up</h3>

            <div>
                <label for="username-input">Username</label>
                <input type="text" name="username" id="username-input">
            </div>

            <div>
                <label for="profile_pic-input">Picture Profile</label>
                <input type="file" name="profile_pic" id="profile_pic-input">
            </div>

            <div>
                <label for="bio-input">Bio</label>
                <textarea name="bio" id=""></textarea>    
            </div>

            <button type="submit" class="btn" name="signup2-btn">Register</button>

            <div class="popup" id="popup">
                <h2>Congratulations!</h2>
                <p>You have successfully logged in</p>
                <p><a href="forum3" href="forum3.html">Click here to start</a></p>
                <button type="button" onclick="closePopup()">OK</button>
            </div>
        </form>

        <p class="login">Already have an account? <a href="main.php?page=login">Log In</a></p>

        <script>
            const popup = document.getElementById("popup");

            function openPopup() {
                const email = document.getElementById("email-input").value.trim();
                const password = document.getElementById("password-input").value.trim();

                if (!email || !password) {
                    alert("Fill out all fields before submitting.");
                } else if (password.length < 8) {
                    alert("At least 8 characters long.");
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