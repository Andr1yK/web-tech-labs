<?php
  function trackPageVisit() {
    $visitedPagesCookie = 'visited_pages.json';

    if (isset($_COOKIE[$visitedPagesCookie])) {
      $visitedPages = json_decode($_COOKIE[$visitedPagesCookie], true);
    } else {
      $visitedPages = [];
    }

    $currentPage = $_SERVER['REQUEST_URI'];

    $visitedPages = array_filter($visitedPages, function($page) use ($currentPage) {
      return $page !== $currentPage;
    });

    array_unshift($visitedPages, $currentPage);

    setcookie($visitedPagesCookie, json_encode($visitedPages), time() + 3600 * 24 * 30, '/'); // Зберігаємо на 30 днів
  }

  function getVisitedPages() {
    $visitedPagesCookie = 'visited_pages';

    if (isset($_COOKIE[$visitedPagesCookie])) {
      $visitedPages = json_decode($_COOKIE[$visitedPagesCookie], true);

      $currentPage = $_SERVER['REQUEST_URI'];

      $visitedPages = array_filter($visitedPages, function($page) use ($currentPage) {
        return $page !== $currentPage;
      });

      return array_values($visitedPages);
    }

    return [];
  }