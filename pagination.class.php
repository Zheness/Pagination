<?php

/**
 * Generate a Pagination (with Bootstrap).
 *
 * @version 1.0.0
 * @link https://github.com/Zheness/Pagination/ Github Repo
 * @author Zheness
 */
class Pagination {

    private $nbMaxElements = 200;
    private $nbElementsInPage = 20;
    private $currentPage = 1;
    private $url = '?page={i}';
    private $innerLinks = 2;
    private $linksSeparator = '...';

    /**
     * Set the maximum elements in your database. (Or other way)
     * 
     * Example :
     * 
     * I have 200 articles in my database, so I type :
     * 
     * $Pagination->setNbMaxElements(200);
     *
     * @param int $int The maximum elements
     * @author Zheness
     */
    public function setNbMaxElements($int) {
        $this->nbMaxElements = (int) $int;
    }

    /**
     * Set the number of elements to display in the page.
     * 
     * Example :
     * 
     * I would display 20 articles per pages, so I type :
     * 
     * $Pagination->setNbElementsInPage(20);
     *
     * @param int $int The number of elements
     * @author Zheness
     */
    public function setNbElementsInPage($int) {
        $this->nbElementsInPage = (int) $int;
    }

    /**
     * Set the current page
     * 
     * Example :
     * 
     * The current page is the 5, so I type :
     * 
     * $Pagination->setCurrentPage(5);
     *
     * @param int $int The current page
     * @author Zheness
     */
    public function setCurrentPage($int) {
        $this->currentPage = (int) $int;
    }

    /**
     * Set the url in the links. You MUST include "{i}" where you want display the number of the page.
     * 
     * Example :
     * 
     * I would display my articles on "articles.php?page=X" where X is the number of page. So I type :
     * 
     * $Pagination->setUrl("articles.php?page={i}");
     * 
     * Why {i} ? Because the number of page can be placed everywhere. If you have your url like this "articles/month/08/page/X/sort/date-desc", you can place {i} instead of X.
     *
     * @param string $string The url in the link
     * @author Zheness
     */
    public function setUrl($string) {
        $this->url = $string;
    }

    /**
     * Set the number of links before and after the current page
     * 
     * Example :
     * 
     * The current page is the 5, and I want 3 links after and before, so I type :
     * 
     * $Pagination->setInnerLinks(3);
     *
     * @param int $int The number of links before and after the current links
     * @author Zheness
     */
    public function setInnerLinks($int) {
        $this->innerLinks = (int) $int;
    }

    /**
     * Set the separtor between links.
     * 
     * Example :
     * 
     * I would display " - " between my links, so I type :
     * 
     * $Pagination->setLinksSeparator(" - ");
     * 
     * By default "..." is display.
     *
     * @param string $string The url in the link
     * @author Zheness
     */
    public function setLinksSeparator($string) {
        $this->linksSeparator = $string;
    }

    /**
     * This is the function to call for render the Pagination.
     * 
     * You have just to configure the options and call this function.
     *
     * @return string The HTML Pagination (it use Bootstrap)
     * @author Zheness
     */
    public function renderBootstrapPagination() {
        $array_pagination = $this->generateArrayPagination();
        $html = $this->generateHtmlPagination($array_pagination);
        return $html;
    }

    /**
     * Generate the Pagination in array.
     *
     * @return array Each value is the link to display.
     * @author Zheness
     */
    private function generateArrayPagination() {
        $array_pagination = array();
        $keyArray = 0;

        $subLinks = $this->currentPage - $this->innerLinks;
        $nbLastLink = ceil($this->nbMaxElements / $this->nbElementsInPage);

        if ($this->currentPage > 1) {
            $array_pagination[$keyArray++] = '<a href="' . str_replace('{i}', 1, $this->url) . '">1</a>';
        }
        if ($subLinks > 2) {
            $array_pagination[$keyArray++] = $this->linksSeparator;
        }
        for ($i = $subLinks; $i < $this->currentPage; $i++) {
            if ($i >= 2) {
                $array_pagination[$keyArray++] = '<a href="' . str_replace('{i}', $i, $this->url) . '">' . $i . '</a>';
            }
        }

        $array_pagination[$keyArray++] = '<b>' . $this->currentPage . '</b>';

        for ($i = ($this->currentPage + 1); $i <= ($this->currentPage + $this->innerLinks); $i++) {
            if ($i < $nbLastLink) {
                $array_pagination[$keyArray++] = '<a href="' . str_replace('{i}', $i, $this->url) . '">' . $i . '</a>';
            }
        }
        if (($this->currentPage + $this->innerLinks) < ($nbLastLink - 1)) {
            $array_pagination[$keyArray++] = $this->linksSeparator;
        }
        if ($this->currentPage != $nbLastLink) {
            $array_pagination[$keyArray++] = '<a href="' . str_replace('{i}', $nbLastLink, $this->url) . '">' . $nbLastLink . '</a>';
        }

        return $array_pagination;
    }

    /**
     * Generate the HTML pagination with the array in parameter
     *
     * @param array $array_pagination The array generate with previous function.
     * @return string Pagination in HTML. Use Bootstrap
     * @author Zheness
     */
    private function generateHtmlPagination($array_pagination) {
        $html = "";
        $html .= '<div class="pagination">';
        $html .= '<ul>';
        if ($this->nbMaxElements) {
            foreach ($array_pagination as $v) {
                if ($v == $this->linksSeparator) {
                    $html .= '<li class="disabled"><span>' . $this->linksSeparator . '</span></li>';
                } else if (preg_match("/<b>(.*)<\/b>/i", $v)) {
                    $html .= '<li class="active"><span>' . strip_tags($v) . '</span></li>';
                } else {
                    $html .= '<li>' . $v . '</li>';
                }
            }
        } else {
            $html .= '<li class="active"><span>1</span></li>';
        }
        $html .= '</ul>';
        $html .= '</div>';
        return $html;
    }

}
