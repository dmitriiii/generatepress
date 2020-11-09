import React from 'react';

class All extends React.Component{
	constructor(props) {
		super(props);
		// console.log(this.props);
		// this.state = {
		// 	coupz: this.props.data.coup_data
		// };
		this.removeFirst = this.removeFirst.bind(this);
    this.showAll = this.showAll.bind(this);
	}

	removeFirst() {
    // let oldd = this.state.coupz;
    // oldd.shift();
    // this.setState({
    //   coupz: oldd
		// });

		// this.setState(function(state, props) {
		// 	let oldd = this.props.data.coup_data;
    // 	oldd.shift();
		// 	return {
		// 		coupz: oldd
		// 	};
		// });


  }

  showAll() {
   alert('gwew');
    // let oldd = this.state.fetchedData.coup_data;
    // // oldd.shift();
    // this.setState({
    //   filteredData: oldd
    // });
  }

	render() {
		let	todoItems = this.props.data.filteredData.map((todo, index) =>
			<div className="gridd__wrr" key={index}>
				<div className="gridd__item">
					<div className="gridd__head">
						<img src={todo.image.url} width={todo.image.width} className="gridd__head-logo" height={todo.image.height}/> 
						<p className="gridd__head-until">Gültig bis {todo.until}</p>
					</div> 
					<div className="gridd__body">
						<h3>{todo.title}</h3>
						<p>{todo.description}</p>
						<div className="gridd__body-butts">
							{todo.code ? <input type="text" readOnly value={todo.code}/> : ''}
							<i className="fas fa-copy"></i>
						</div>
					</div>  
					
				</div>
			</div>
		);	
    return (
      <div className="contt">
        <button onClick={this.removeFirst}>Remove first!</button>
        <button onClick={this.showAll}>Show All!</button>
        <div className="gridd">
          {todoItems}
        </div>
      </div>
    );
  }
}

export default All;
