<?php
include('resource/view/include/index.php');
include_once("common/Translation.php");
$selectedLang = isset($_GET['lang']) ? $_GET['lang'] : $_SESSION['LANG'] ?? $GLOBALS['LANG'];
$selectedLang = in_array($selectedLang, $GLOBALS['SUPPORTED_LANG']) ? $selectedLang : $GLOBALS['LANG'];
$_SESSION['LANG'] = $selectedLang;
$lang = $_SESSION['LANG'];
$translationFile = "resource/lang/{$lang}/language.php";
Translation::loadTranslations($translationFile);
$currentLangName = ($lang === 'en') ? 'ENGLISH' : 'العربية';
$currentLangIcon = ($lang === 'en') ? 'public/assets/images/favicon/en.png' : 'public/assets/images/favicon/ar.png';
$t = $GLOBALS['t'];

?>
<footer class="footer" id="footer">
    <div class="footer">
        <div class="inner-footer">
        <div class="footer-items">
        <h3><?php $t('Select-Language')?></h3>
        <div class="dropdown">
            <button class="dropbtn"><?php $t('Language')?></button>
            <div class="dropdown-content">
                <a href="?lang=en"><img src="public/assets/images/favicon/en.png"> English</a>
                <a href="?lang=ar"><img src="public/assets/images/favicon/ar.png" style="height: 13px;"> Arabic</a>
            </div>
        </div>
    </div>

    <script>
        /* JavaScript for Dropdown Menu */
        document.addEventListener("DOMContentLoaded", function() {
            var dropdowns = document.querySelectorAll(".dropdown");
            dropdowns.forEach(function(dropdown) {
                var button = dropdown.querySelector(".dropbtn");
                var content = dropdown.querySelector(".dropdown-content");
                button.addEventListener("click", function() {
                    content.classList.toggle("show");
                });
            });

            // Close the dropdown if the user clicks outside of it
            window.addEventListener("click", function(event) {
                if (!event.target.matches('.dropbtn')) {
                    var dropdowns = document.querySelectorAll(".dropdown-content");
                    dropdowns.forEach(function(content) {
                        if (content.classList.contains('show')) {
                            content.classList.remove('show');
                        }
                    });
                }
            });
        });
    </script>

            <div class="footer-items">


                <h3><?php $t('Quick-Links')?></h3>

                <ul>
			<?php	if(@$_SESSION['SSCF_login_id'] > 0)
					{
				echo '<li><a href="dashboard">'.$t("My-Account",1).'</a></li>';
                echo '<li><a href="cart">'.$t("My-Cart",1).'</a></li>';

					}else{
						echo '<li><a href="login">'.$t("Login",1).'</a></li>';
                        echo '<li><a href="register-account">'.$t("SignUp",1).'</a></li>';
					}?>
                    <li><a href="about"><?php $t('About-Us')?></a></li>
                    <li><a href="contact"><?php $t('Contact-Us')?></a></li>
                    
                </ul>
            </div>
            <div class="footer-items">
                <h3><?php $t('Contact-Us')?></h3>

                <ul>
                    <li class="flex-info">
                        <i class='bx bxs-phone box-icon'></i>
                        <div><?php echo $GLOBALS['phone-store'] ?></div>

                    </li>
                    <li class="flex-info"><i class='bx bxs-location-plus  box-icon'></i>

                        <div><?php echo $GLOBALS['address-store'] ?></div>

                    </li>
                    <li class="flex-info">
                        <i class='bx bxs-envelope  box-icon'></i>
                        <div><?php echo $GLOBALS['email-store'] ?></div>
                    </li>
                </ul>
            </div>
        </div>
        <hr />

        <div class="footer-bottom">
        &copy;  <?= date('Y') ?>   <?=  $GLOBALS['NameWebsite'] ?> <?php $t('All Rights Reserved')?>   
        </div>
    </div>
    </div>
</footer>

<script src="public/assets/js/common/upload-files.js"></script>
<script src="public/assets/js/client/slider.js"></script>
<script src="public/assets/js/client/tabs.js"></script>
<script src="public/assets/js/client/script.js"></script>


</body>

</html>