<?php
if (! function_exists('paginate')) {
    /**
     * Create a new paginator instance from array.
     *
     * @param array $array
     * @param int $perPage
     * @param string $pageName
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    function paginate(array $array, $perPage = 1, $pageName = 'page')
    {
        $col = new \Illuminate\Support\Collection($array);

        $currentPage = request($pageName, 1);

        $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $entries = new \Illuminate\Pagination\LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);

        return $entries;
    }
}
