import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class NavbarTop extends Component {
	constructor(props) {
  		super(props);
	}

	render() {
        return (
			<ul className="navbar-top">{this.props.children}</ul>
		);
	}
}