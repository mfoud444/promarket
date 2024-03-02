<?php
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
