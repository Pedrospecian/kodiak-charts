import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Header from '../../blocks/header';
import Content from '../../blocks/content';
import Footer from '../../blocks/footer';

export default class ArchiveSingle extends Component {
    render() {
        return (
            <div>arquivos</div>
        );
    }
}

if (document.getElementById('root-archive-single')) {
    ReactDOM.render(<ArchiveSingle />, document.getElementById('root-archive-single'));
}
