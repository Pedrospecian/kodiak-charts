@extends('layouts.front')

@section('content')
<div class="container">
    <div class="content">
        <div class="home-chart-wrapper">
            <a href="/charts/4">
                <div class="home-chart-element">
                    <div class="front">
                        <div class="text-wrapper text-shadow">
                            <div class="name">
                                Grand 50 Songs
                            </div>
                            <div class="auxiliar">
                                        
                                <div class="big">King Nothing</div>
                                <div class="small">Metallica</div>
                            </div>
                        </div>                 
                    </div>
                    <div class="middle"></div>
                    <div class="back">                    
                        <img src="{{ asset('/images/upload/15873408448RAU7Af.png') }}" />
                    </div>
                </div>
            </a>
            <a href="/chartsArtists/2">
                <div class="home-chart-element">
                    <div class="front">
                        <div class="text-wrapper text-shadow">
                            <div class="name">
                                Grand 20 Artists
                            </div>
                            <div class="auxiliar">                                        
                                <div class="big">Metallica</div>
                            </div>
                        </div>                 
                    </div>
                    <div class="middle"></div>
                    <div class="back">                    
                        <img src="{{ asset('/images/upload/15873408448RAU7Af.png') }}" />
                    </div>
                </div>
            </a>
            <a href="/charts/5">
                <div class="home-chart-element">
                    <div class="front">
                        <div class="text-wrapper text-shadow">
                            <div class="name">
                                Hot 50 Songs
                                <br>
                                Of The Week
                            </div>
                            <div class="auxiliar">                                        
                                <div class="big">King Nothing</div>
                                <div class="small">Metallica</div>
                            </div>
                        </div>                 
                    </div>
                    <div class="middle"></div>
                    <div class="back">                    
                        <img src="{{ asset('/images/upload/15873408448RAU7Af.png') }}" />
                    </div>
                </div>
            </a>
            <a href="/chartsArtists/3">
                <div class="home-chart-element">
                    <div class="front">
                        <div class="text-wrapper text-shadow">
                            <div class="name">
                                Hot 20 Artists
                                <br>
                                Of The Week
                            </div>
                            <div class="auxiliar">                                        
                                <div class="big">Metallica</div>
                            </div>
                        </div>                 
                    </div>
                    <div class="middle"></div>
                    <div class="back">                    
                        <img src="{{ asset('/images/upload/15873408448RAU7Af.png') }}" />
                    </div>
                </div>
            </a>
            <a href="/charts/7">
                <div class="home-chart-element">
                    <div class="front">
                        <div class="text-wrapper text-shadow">
                            <div class="name">
                                Hot 20 Main-
                                <br>
                                stream Songs
                            </div>
                            <div class="auxiliar">                                        
                                <div class="big">King Nothing</div>
                                <div class="small">Metallica</div>
                            </div>
                        </div>                 
                    </div>
                    <div class="middle"></div>
                    <div class="back">                    
                        <img src="{{ asset('/images/upload/15873408448RAU7Af.png') }}" />
                    </div>
                </div>
            </a>
            <a href="/charts/6">
                <div class="home-chart-element">
                    <div class="front">
                        <div class="text-wrapper text-shadow">
                            <div class="name">
                                Hot 100 Songs
                                <br>
                                Of The Year
                            </div>
                            <div class="auxiliar">                                        
                                <div class="big">King Nothing</div>
                                <div class="small">Metallica</div>
                            </div>
                        </div>                 
                    </div>
                    <div class="middle"></div>
                    <div class="back">                    
                        <img src="{{ asset('/images/upload/15873408448RAU7Af.png') }}" />
                    </div>
                </div>
            </a>
            <a href="/chartsArtists/4">
                <div class="home-chart-element">
                    <div class="front">
                        <div class="text-wrapper text-shadow">
                            <div class="name">
                                Hot 50 Artists
                                <br>
                                Of The Year
                            </div>
                            <div class="auxiliar">                                        
                                <div class="big">Metallica</div>
                            </div>
                        </div>                 
                    </div>
                    <div class="middle"></div>
                    <div class="back">                    
                        <img src="{{ asset('/images/upload/15873408448RAU7Af.png') }}" />
                    </div>
                </div>
            </a>
            <a href="">
                <div class="home-chart-element">
                    <div class="front">
                        <div class="text-wrapper text-shadow">
                            <div class="name">
                                Top 50 Anime Deaths
                            </div>
                            <div class="auxiliar">
                                        
                                <div class="big">King Nothing</div>
                                <div class="small">Metallica</div>
                            </div>
                        </div>                 
                    </div>
                    <div class="middle"></div>
                    <div class="back">                    
                        <img src="{{ asset('/images/upload/15873408448RAU7Af.png') }}" />
                    </div>
                </div>
            </a>
        </div>
        <!--<HomeChart color="blue" img="" name="" no1Music="King Nothing" no1Artist="Metallica" link="https://www.youtube.com/watch?v=V5j8lz4oD4Q"/>
        <HomeChart color="green" img="" name="" no1Music="War Horns" no1Artist="Angra" link="https://www.youtube.com/watch?v=Dgor7ZuG9nU"/>
        <HomeChart color="red" img="" name="" no1Music="Love Train" no1Artist="The O'Jays" link="https://www.youtube.com/watch?v=2vTKmVvyNRc"/>
        <HomeChart color="yellow" img="" name="" no1Music="Glory of the World" no1Artist="Stratovarius" link="https://www.youtube.com/watch?v=tzvY77AmLtw"/>
        <HomeChart color="purple" img="" name="" no1Music="Harlequin Forest" no1Artist="Opeth" link="https://www.youtube.com/watch?v=nIo3lpXrc5A"/>
        <HomeChart color="magenta" img="" name="" no1Music="Like a Child" no1Artist="Noel" link="https://www.youtube.com/watch?v=823P49o4qmI"/>
        <HomeChart color="cyan" img="" name="" no1Music="People are People" no1Artist="Depeche Mode" link="https://www.youtube.com/watch?v=MzGnX-MbYE4"/>
        <HomeChart color="orange" img="" name="" no1Music="Mad World" no1Artist="Tears for Fears" link="https://www.youtube.com/watch?v=u1ZvPSpLxCg"/>-->
    </div>
</div>
@endsection