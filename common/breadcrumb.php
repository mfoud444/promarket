<?php
class BreadcrumbGenerator {
    public static function generateBreadcrumb($links) {
        if (empty($links)) {
            return ''; 
        }

        $breadcrumbHTML = '<div class="breadcrumb">';
        $count = count($links);

        foreach ($links as $index => $link) {
            $isActive = ($index === $count - 1) ? 'active' : '';
            $breadcrumbHTML .= '<a href="' . $link['url'] . '" class="' . $isActive . '">' . $link['label'] . '</a>';

            if ($index < $count - 1) {
             
                $breadcrumbHTML .= '<i class="arrow bx bx-chevron-right"></i>';
            }
        }

        $breadcrumbHTML .= '</div>';
        return $breadcrumbHTML;
    }
}