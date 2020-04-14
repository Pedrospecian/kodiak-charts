import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class HomeChart extends Component {
	constructor(props) {
  		super(props);
	}

	render() {
        return (
			<a href={this.props.link} target="_blank">
				<div className="home-chart-element" style={{color: this.props.color}}>
					<img src={this.props.img}/>
					<div className="no1-music-name">{this.props.no1Music}</div>
					<div className="no1-artist-name">{this.props.no1Artist}</div>
				</div>
			</a>
		);
	}
}