import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

import { environment } from 'environments/environment';

@Injectable({
  providedIn: 'root'
})
export class PostService {

  constructor(private m_http: HttpClient) { }

  // POSTS

  createPost(eventId: number, form: Object): Observable<any> {
    const URL = `${environment.backend.serverUrl}events/${eventId}/posts`;
    return this.m_http.post<any>(URL, JSON.stringify(form));
  }

  updatePost(eventId: number, postId: number, form: Object): Observable<any> {
    const URL = `${environment.backend.serverUrl}events/${eventId}/posts/${postId}`;
    return this.m_http.patch<any>(URL, JSON.stringify(form));
  }

  deletePost(eventId: number, postId: number): Observable<any> {
    const URL = `${environment.backend.serverUrl}events/${eventId}/posts/${postId}`;
    return this.m_http.delete<any>(URL);
  }

  // COMMENTS

  createComment(eventId: number, postId: number, form: Object): Observable<any> {
    const URL = `${environment.backend.serverUrl}events/${eventId}/posts/${postId}/comments`;
    return this.m_http.post<any>(URL, JSON.stringify(form));
  }

  updateComment(eventId: number, postId: number, commentId: number, form: Object): Observable<any> {
    const URL = `${environment.backend.serverUrl}events/${eventId}/posts/${postId}/comments/${commentId}`;
    return this.m_http.patch<any>(URL, JSON.stringify(form));
  }

  deleteComment(eventId: number, postId: number, commentId: number): Observable<any> {
    const URL = `${environment.backend.serverUrl}events/${eventId}/posts/${postId}/comments/${commentId}`;
    return this.m_http.delete<any>(URL);
  }
}
