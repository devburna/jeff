<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $comments = (new Comment($_REQUEST))->index();


    function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    (new Comment($_REQUEST))->store();
}

class Comment
{
    private $servername, $database, $username, $password;

    public function __construct($request)
    {
        $this->servername = '127.0.0.1';
        $this->database = 'jeff';
        $this->username = 'root';
        $this->password = null;

        $this->request = $request;
    }

    public function connect()
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    public function index()
    {
        $sql = "SELECT * FROM comment WHERE approved_at IS NOT NULL";
        $comments = $this->connect()->query($sql);

        $this->connect()->close();

        return $comments;
    }

    public function store()
    {
        $username = $this->request['username'];
        $comment = $this->request['comment'];
        if (!$username || !$comment) {
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit;
        } else {
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "INSERT INTO comment (post_id, username, comment) VALUES (1,'$username', '$comment')";

            if ($this->connect()->query($sql) === TRUE) {
                header("Location: {$_SERVER['HTTP_REFERER']}");
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $this->connect()->error;
            }

            $this->connect()->close();
        }
    }
}
