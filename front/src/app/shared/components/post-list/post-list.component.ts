import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

import { Post } from 'app/shared/models/post';
import { PostService } from 'app/modules/events/post.service';
import { AuthService } from 'app/core/services/auth.service';
import { MatDialog } from '@angular/material';
import { DialogComponent } from '../dialog/dialog.component';

enum PostState {
  Read,
  Create,
  Update
}

@Component({
  selector: 'app-post-list',
  templateUrl: './post-list.component.html',
  styleUrls: ['./post-list.component.scss']
})
export class PostListComponent implements OnInit {
  @Input() posts: Post[];
  @Input() eventId: number;
  @Output() updated = new EventEmitter<any>();
  
  postForm: FormGroup;
  postState = PostState;
  currentState = PostState.Read;
  userId: number;
  postIdToUpdate: number;

  constructor(private m_postService: PostService,
    private m_formBuilder: FormBuilder,
    authService: AuthService,
    private m_dialog: MatDialog) {
    this.postForm = this.m_formBuilder.group({
      title: ['', Validators.required],
      content: ['', Validators.required]
    });

    this.userId = authService.getUserId();
  }

  ngOnInit() {
  }

  submitCreateForm(): void {
    this.m_postService.createPost(this.eventId, this.postForm.value).subscribe(result => {
      this.currentState = PostState.Read;
      this.updated.emit(undefined);
    }, error => {

    });
  }

  submitEditForm(): void {
    this.m_postService.updatePost(this.eventId, this.postIdToUpdate, this.postForm.value).subscribe(result => {
      this.currentState = PostState.Read;
      this.postIdToUpdate = undefined;
      this.patchForm(undefined);
      this.updated.emit(undefined);
    }, error => {

    });
  }

  deletePost(): void {
    const dialogRef = this.m_dialog.open(DialogComponent, {
      width: "500px",
      data: {title: `Suppression d'un post`, text: `En êtes-vous bien sûr ?`, bValBtn: true}
    });

    dialogRef.afterClosed().subscribe(result => {
      if (result.validated) {
        this.m_postService.deletePost(this.eventId, this.postIdToUpdate).subscribe(result => {
          this.currentState = PostState.Read;
          this.postIdToUpdate = undefined;
          this.updated.emit(undefined);
        }, error => {

        });
      }
    });
  }

  reloadComments(): void {
    this.updated.emit(undefined);
  }

  patchForm(post: Post | undefined): void {
    if (post == undefined) {
      this.postForm.patchValue({
        title: '',
        content: ''
      });
    } else {
      this.postForm.patchValue({
        title: post.title,
        content: post.content
      });
    }
  }
}
