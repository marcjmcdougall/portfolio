import { Link } from 'gatsby'
import React from "react"
import { PopupText } from "react-calendly"

export default function Navbar() {
	
  return (

      <nav id="main-nav" className="container">

        <div className="row">

    			<div className="col-6"><Link to="/"><img src="/signature.png" alt="Marc McDougall's signature" style={{ maxWidth: '125px' }}/></Link></div>

    			<div className="col-6 right">

    				<ul>

    					<li><Link to="/">Home</Link></li>
    					<li><Link to="/portfolio">Portfolio</Link></li>
    					<li><Link to="/testimonials">Testimonials</Link></li>
    					<li class="schedule"><PopupText className="button" url="https://calendly.com/kbs-marc/strategy-call" text="Let's Talk"></PopupText></li>

    				</ul>

    			</div>

        </div>

  		</nav>
  	)
}
