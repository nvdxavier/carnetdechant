<?php

//use controllers\indexController\uploadController;

require_once "controllers/uploadController.php";

//$uploadcontroller = new uploadController();
?>


<div id="mydiv"></div>

<script type="text/babel">
    class MyForm extends React.Component {
        constructor(props) {
            super(props);
            this.state = { username: '' };
        }
        mySubmitHandler = (event) => {
            event.preventDefault();
            alert("You are submitting " + this.state.username);
        };
        myChangeHandler = (event) => {
            this.setState({username: event.target.value});
        };
        render() {
            return (
                <form onSubmit={this.mySubmitHandler}>
                    <h1>Hello {this.state.username}</h1>
                    <p>Enter your name, and submit:</p>
                    <input
                        type='file' name="myfiles"
                        onChange={this.myChangeHandler}
                    />
                    <input
                        type='submit'
                    />
                </form>
            );
        }
    }

    ReactDOM.render(<MyForm />, document.getElementById('mydiv'))
</script>

<form action="?page=uploadedFiles" method="post" enctype="multipart/form-data">
    <input type="file" name="myfiles">
    <input type="submit" name="submit" value="upload file">
</form>

