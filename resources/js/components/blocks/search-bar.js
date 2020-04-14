import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import iconSearch from '../../../images/icon-search.png';
import iconClose from '../../../images/icon-close.png';

export default class SearchBar extends Component {
	constructor(props) {
	    super(props);
	    this.state = {active: false};
	    this.openSearch = this.openSearch.bind(this);
	    this.closeSearch = this.closeSearch.bind(this);
	}

	openSearch() {
		this.setState({active: true});
	}

	closeSearch() {
		this.setState({active: false});
	}

	render() {
		/*
		A busca procura por artistas somente, ai qdo vc escreve nela aparece uma lista
		de sugestão de artistas baseado no que voce esta digitando
		*/
        return (
			<form className={`form-search ${this.state.active ? 'active' : ''}`}>
				<div className="search-field-wrapper">
					<input type="text" name="search" placeholder="Buscar"/>
				</div>
				<button type="button" onClick={this.openSearch}><img src={iconSearch} alt="Busca" /></button>
				<button type="button" className="btn-close" onClick={this.closeSearch}><img src={iconClose} alt="Fechar" /></button>
			</form>
		);
	}
}