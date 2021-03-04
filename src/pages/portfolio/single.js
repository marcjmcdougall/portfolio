import React from "react"
import { graphql, Link } from 'gatsby'
import LayoutStandard from '../../components/layouts/Standard' 

export default function SinglePortfolio({data}) {

	const post = data.allWpPost.nodes[0]
	
  	return (

  		<LayoutStandard>

	  		<section className="row">

	  			<div className="col-7">

	  				<h1>{post.title}</h1>

	  			</div>

	  		</section>

	  		<section className="row">

	  			<div className="col-7"dangerouslySetInnerHTML={{ __html: post.content }} />

	  		</section>

	  		<section className="row pagination">

	  			<div className="col-8">
	  			
		  			<ul>

						<li><Link className="current" to="#">1</Link></li>
						<li><Link to="#">2</Link></li>
						<li><Link to="#">3</Link></li>
						<li><Link to="#">4</Link></li>

					</ul>

				</div>

	  		</section>

  		</LayoutStandard>
  	)
}

export const query = graphql`
  query($slug: String!) {
    allWpPost(filter: { slug: { eq: $slug } }) {
      nodes {
        title
        content
      }
    }
  }
`
