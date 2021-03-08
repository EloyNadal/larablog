<!DOCTYPE html>
<html>

<head>
    <title>My first React app</title>
    <script src="https://unpkg.com/react@17/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js" crossorigin></script>
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
</head>

<body>

    <div id="input"></div>
    <div id="todo"></div>

<script type="text/babel">

//componente texto
class NameForm extends React.Component {
  constructor(props) {
    super(props);
    this.state = {value: ''};

    this.handleChange = this.handleChange.bind(this);
  }

  handleChange(event) {
    this.setState({value: event.target.value});
  }

  render() {
    return (
      <form onSubmit={this.handleSubmit}>
        <p id="message">{this.state.value}</p>
        <label>
          Name:
          <input type="text" value={this.state.value} onChange={this.handleChange} />
        </label>
      </form>
    );
  }
}
ReactDOM.render(
  <NameForm />,
  document.getElementById('input')
);

//componente lista
class Todo extends React.Component {
  constructor(props) {
    super(props);
    this.state = {list: ['Learn JavaScript', 'Learn Vue', 'Learn Vue 3'], value: ''};

    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleChange = this.handleChange.bind(this);
  }

  handleSubmit(event) {
    event.preventDefault();
    let list = this.state.list;
    list.push(this.state.value);

    this.setState({list: list, value: '' });

  }
  handleChange(event) {

    this.setState({value: event.target.value});
  }

  render () {
    return (
        <div>
            <ol>
                {this.state.list.map(text => <li key={text}> {text} </li>)}
            </ol>

            <form onSubmit={this.handleSubmit}>
            <label>
                Texto a añadir:
                <input type="text" value={this.state.value} onChange={this.handleChange} />
            </label>
            </form>

        </div>
        );
    }
}

ReactDOM.render(
  <Todo />,
  document.getElementById('todo')
);

</script>
</body>

</html>
