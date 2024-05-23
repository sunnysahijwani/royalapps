<?php

namespace App\Services;

use App\Interfaces\AuthorInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AuthorServices implements AuthorInterface
{

    /**
     * Sends an HTTP request using the specified method and parameters.
     *
     * @param string $url The URL to send the request to.
     * @param string $method The HTTP method to use (e.g., GET, POST).
     * @param array $params The parameters to include in the request body (for POST and PUT methods).
     * @return \Illuminate\Http\Client\Response The response from the server.
     */
    public function httpCallMethod($url, $method, $params)
    {

        return Http::withHeaders([

                    "Content-Type" => "application/json",
                    "Authorization" => "Bearer " . session('token_key'),

                ])->$method($url, $params);
    }


    public function list($request): array
    {
        $data = [];
        try {

            $url = config('royalapp.api_v2.url') . "/authors";

            $response = $this->httpCallMethod($url, 'get', []);

            if ($response->status() != 200) {

                throw new Exception("Authors Record Not Found !");
            }

            $data['result'] = $response->json()["items"];

            $data['code'] = 201;
            $data['error'] = false;
            $data['msg'] = 'Author Record List successfully Fetched !';
            return $data;
        } catch (\Exception $e) {
            $data['code'] = 422;
            $data['error'] = true;
            $data['result'] = [];
            $data['msg'] = $e->getMessage();
            return $data;
        }
    }

    public function view($request, $authorId)
    {
        $data = [];
        try {

            $url = config('royalapp.api_v2.url') . "/authors/$authorId";

            $response = $this->httpCallMethod($url, 'get', []);

            if ($response->status() != 200) {

                throw new Exception("Author Record Not Found !");
            }

            $data['result'] = $response->json();
            $data['code'] = 201;
            $data['error'] = false;
            $data['msg'] = 'Author Record Fetched successfully !';
            return $data;
        } catch (\Exception $e) {
            $data['code'] = 422;
            $data['error'] = true;
            $data['result'] = [];
            $data['msg'] = $e->getMessage();
            return $data;
        }
    }

    public function delete($request, $Id)
    {
        $data = [];
        try {
            /*
            1.  check if Author provided is valid
            2.  proceed further only if there is no single book is authored by this author in the database.
            */
            $authorRecords = $this->view($request, $Id);
            // check if Author is valid
            if ($authorRecords && $authorRecords['code'] !== 201) {
                $data['code'] = 422;
                $data['error'] = true;
                $data['msg'] = "Authors does not exists in the system!";
                return $data;
            }
            // now proceed further only if there is no book authored by this author ID.
            if (isset($authorRecords['result']['books']) && count($authorRecords['result']['books']) <= 0) {

                $url = config('royalapp.api_v2.url') . "/authors/$Id";

                $response = $this->httpCallMethod($url, 'delete', []);

                if ($response->status() !== 204) {

                    throw new Exception("Author Record Not Deleted !");
                }

                $data['code'] = 201;
                $data['error'] = false;
                $data['msg'] = 'Author Record Deleted successfully !';
                return $data;
            } else {

                $data['code'] = 422;
                $data['error'] = true;
                $data['msg'] = "Not allowed to delete Author with books in the database!";
                return $data;
            }
        } catch (\Exception $e) {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();

            return $data;
        }
    } //function delete ends

    public function search($request)
    {
        $data = [];
        $query = $request->get('query');
        $sortBy = $request->get('sortby'); //intend to use later
        $sortType = $request->get('sorttype'); //intend to use later
        try {

            $url = config('royalapp.api_v2.url') . "/authors";

            $response = $this->httpCallMethod($url, 'get', [
                "query" => $query,
            ]);

            if ($response->status() != 200) {

                throw new Exception("Authors Record Not Found !");
            }

            $data['result'] = $response->json()["items"];

            if (count($data['result']) > 0) {
                foreach ($data['result'] as $key => $value) {
                    $data['record'][] = [
                        "id" => $value['id'],
                        "text" => $value['first_name'] . " " . $value['last_name'],
                    ];
                }
            }
            $data['code'] = 201;
            $data['error'] = false;
            $data['msg'] = 'Author Record List successfully Fetched !';
            return $data;
        } catch (\Exception $e) {
            $data['code'] = 422;
            $data['error'] = true;
            $data['record'] = [];
            $data['msg'] = $e->getMessage();
            return $data;
        }
    } // function search ends 

}
