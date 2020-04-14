import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Header from '../../blocks/header';
import Content from '../../blocks/content';
import Footer from '../../blocks/footer';

export default class Archive extends Component {
    render() {
        return (
            <div>arquivos</div>
        );
    }
}

if (document.getElementById('root-archive')) {
    ReactDOM.render(<Archive />, document.getElementById('root-archive'));
}
