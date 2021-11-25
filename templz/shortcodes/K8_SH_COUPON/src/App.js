import React from 'react';
import './App.css';

class App extends React.Component{
  constructor(props) {
    super(props);
    this.state = {
      isFetched: false,
      selectedCat: this.props.category,
      selectedTyp: this.props.type,
      inrow: this.props.inrow,
    };
    this.showAll = this.showAll.bind(this);
    this.handleCatChange = this.handleCatChange.bind(this);
    this.handleTypChange = this.handleTypChange.bind(this);
    this.handleSpecoffer = this.handleSpecoffer.bind(this);
    this.updateInRow = this.updateInRow.bind(this);
  }

  componentDidMount(){
    fetch(this.props.fUrl)
      .then(response => response.json())
      .then((jsonData) => {
        this.setState({
          isFetched: true,
          fetchedData: jsonData,
          filteredData: jsonData.coup_data
        });
      })
      .catch((error) => {
        console.error(error)
      })
  }

  showAll() {
    this.setState(function(state, props) {
      return {
        filteredData: state.fetchedData.coup_data,
        selectedCat: 'all',
        selectedTyp: 'all',
      };
    });    
  }

  handleCatChange(event) {
    this.setState(function(state, props) {
      return {
        selectedCat: event.target.value
      };
    });
  }

  handleTypChange(event) {
    this.setState(function(state, props) {
      return {
        selectedTyp: event.target.value
      };
    });
  }

  handleSpecoffer(event) {
    this.setState(function(state, props) {
      return {
        selectedTyp: event.target.value
      };
    });
  }

  updateInRow(event) {
    this.setState(function(state, props) {
      return {
        inrow: event.target.value
      };
    });
  }

  render() {
    let todoItems = 'Loading..';
    if(this.state.isFetched){
      let filteredData = this.state.filteredData;
      const filtersCat = this.state.fetchedData.fill_data.category;
      const filtersTyp = this.state.fetchedData.fill_data.type;
      const maxWidth = (100 / this.state.inrow);
      const selCat = Object.keys(filtersCat).map(function(keyName, keyIndex) {
        return <option value={keyName} key={keyIndex}>{filtersCat[keyName]}</option>
      });
      
      const selTyp = Object.keys(filtersTyp).map(function(keyName, keyIndex) {
        return <option value={keyName} key={keyIndex}>{filtersTyp[keyName]}</option>
      });

      if( this.state.selectedCat !== 'all' ){
        filteredData = filteredData.filter(coupon => coupon.category.includes(this.state.selectedCat));
      }
      if( this.state.selectedTyp !== 'all' ){
        filteredData = filteredData.filter(coupon => coupon.type.includes(this.state.selectedTyp));
      }

      todoItems = filteredData.map((todo, index) =>
        <div className="gridd__wrr" key={index} style={{maxWidth: maxWidth + "%"}}>
          <div className="gridd__item" data-type={todo.type.join(' ')}>
            <div className="gridd__head">
              <img className="gridd__head-logo" src={todo.image.url} width={todo.image.width} height={todo.image.height} alt={todo.title}/> 
              <p className="gridd__head-until">Gültig bis {todo.until}</p>
              {todo.discount &&
                <span className="gridd__head-discount">{todo.discount}</span>
              }
            </div> 
            <div className="gridd__body">
              <h3>{todo.title}</h3>
              <div className="gridd__body-txt">
                <p>{todo.description}</p>
              </div>
              <div className="gridd__butts">
                {todo.code ?
                  <div className="gridd__butt gridd__butt-code">
                    <span>{todo.code}</span>
                    <i className="fas fa-copy"></i>
                  </div> :
                  <span>&nbsp;</span>
                }
                <a href={todo.url} className="gridd__butt gridd__butt-url" rel="nofollow" target="_blank">
                  ANGEBOT SEHEN
                  <i className="fas fa-thumbs-up"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      );
   

    return (
      <div className="contt">
        {this.props.filters === 'yes' &&
        <div className="contt__filterz"> 
          <select className="contt__control" value={this.state.selectedCat} onChange={this.handleCatChange}>
            {selCat}
          </select>
          <select className="contt__control" value={this.state.selectedTyp} onChange={this.handleTypChange}>
            {selTyp}
          </select>
          <div>
            <label className="contt__control contt__control-radio">
              <input
                type="radio"
                value="blackfriday"
                checked={this.state.selectedTyp === 'blackfriday' ? true : false}
                onChange={this.handleSpecoffer} />
                <span>Black Friday</span>
            </label>
            <label className="contt__control contt__control-radio">
              <input
                type="radio"
                value="cybermonday"
                checked={this.state.selectedTyp === 'cybermonday' ? true : false}
                onChange={this.handleSpecoffer} />
                <span>Cyber Monday</span>
            </label>
            <label className="contt__control contt__control-radio">
              <input
                type="radio"
                value="x-mas"
                checked={this.state.selectedTyp === 'x-mas' ? true : false}
                onChange={this.handleSpecoffer} />
                <span>X-mas</span>
            </label>
          </div>
          <span className="contt__control"><i className="fas fa-tags"></i>{todoItems.length}</span>
          {this.state.selectedCat !== 'all' || this.state.selectedTyp !== 'all' 
            ? <button className="contt__control" onClick={this.showAll}>Reset <i className="fas fa-backspace"></i></button>
            : ''
          }
          <label className="contt__control contt__control-perrow">
            <i className="fas fa-columns"></i> :
            <select value={this.state.inrow} onChange={this.updateInRow}>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
            </select>
          </label>
        </div>
        }
        <div className="gridd">
          {todoItems}
        </div>
      </div>
    );
  }
    // Not fetched data yet
    else{
      return (<div>{todoItems}</div>)
    }
  }

}



export default App;
