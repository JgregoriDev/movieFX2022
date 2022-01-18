<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class MovieController
{


    private array $movies = [
        ["id"=>"2", "title" => "Ava", "tagline" => "Kill. Or be killed",
            "release_date" => "2020-09-25"],
        ["id" => "3", "title" => "Bill &Ted Face the Music",
            "tagline" => "The future awaits", "release_date" => "2020-09-24"],
        ["id" => "4", "title" => "Hard Kill",
            "tagline" => "Take on a madman. Save the world.", "release_date" => "2020-09-14"],
        ["id" => "5", "title" => "The Owners", "tagline" => "",
            "release_date" => "2020-05-10"],
        ["id" => "6", "title" => "The New Mutants",
            "tagline" => "It's time to face your demons.", "release_date" => "2020-04-20"],
    ];




    /**
     * @Route("/movies/{id}", name="movies_show", requirements={"id"="\d+"})     */
    public function show($id)
    {
        $result = array_filter($this->movies,
            function($movie) use ($id)
            {
                return $movie["id"] == $id;
            });
        if (count($result) > 0)
        {
            $response = "";
            $result = array_shift($result);
            $response .= "<ul><li>" . $result["title"] . "</li>" .
                "<li>" . $result["tagline"] . "</li>" .
                "<li>" . $result["release_date"] . "</li></ul>";
            return new Response("<html><body>$response</body></html>");
        }
        else
            return new Response("Movie not found");
    }


    /**
     * @Route("/movies/{text}", name="movies_filter")
     */
    public function filter($text)
    {
        $result = array_filter($this->movies,
            function($movie) use ($text)
            {
                return strpos($movie["title"], $text) !== false;
            });
        $response = "";
        if (count($result) > 0)
        {
            foreach ($result as $movie) {
                $response .= "<ul><li>" . $movie["title"] . "</li>" .
                    "<li>" . $movie["tagline"] . "</li>" .
                    "<li>" . $movie["release_date"] . "</li></ul>";
            }
            return new Response("<html><body>$response</body></html>");
        }
        else
            return new Response("No movies found");
    }
}