import { Link } from 'gatsby'
import React from "react"

export default function Navbar() {
	
  return (

  		<nav>

  			<p>Marc McDougall</p>

  			<div class="navigation">

  				<ul>

  					<li><Link to="/">Home</Link></li>
  					<li><Link to="/portfolio">Portfolio</Link></li>
  					<li><Link to="/testimonials">Testimonials</Link></li>
  					<li><Link to="/contact">Let's Talk</Link></li>

  				</ul>

  			</div>

  		</nav>
  	)
}
