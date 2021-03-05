import React from "react"
import { graphql, Link } from 'gatsby'
import LayoutStandard from '../../components/layouts/Standard' 

export default function SinglePortfolio({data}) {

	const post = data.allWpPortfolio.nodes[0]
	
  	return (

  		<LayoutStandard>

	  		<section className="row">

	  			<div className="col-8">

	  				<h1>Case Study: {post.title}</h1>

	  			</div>

	  		</section>

	  		<section className="row">

	  			<div className="col-8 blog-content" dangerouslySetInnerHTML={{ __html: post.content }} />

	  		</section>

  		</LayoutStandard>
  	)
}

export const query = graphql`
  query($slug: String!) {
    allWpPortfolio(filter: { slug: { eq: $slug } }) {
      nodes {
        title
        content
      }
    }
  }
`
