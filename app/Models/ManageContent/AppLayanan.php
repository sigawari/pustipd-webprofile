<?php
// app/Models/ManageContent/AppLayanan.php

namespace App\Models\ManageContent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class AppLayanan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'applayanans';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'appname',
        'description', 
        'category',
        'applink',
        'status'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'status' => 'string',
        'category' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // ================================
    // SCOPES
    // ================================

    /**
     * Scope a query to only include published applications.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope a query to only include draft applications.
     */
    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope a query to only include archived applications.
     */
    public function scopeArchived(Builder $query): Builder
    {
        return $query->where('status', 'archived');
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    /**
     * Scope a query to only include applications with links.
     */
    public function scopeWithLink(Builder $query): Builder
    {
        return $query->whereNotNull('applink');
    }

    /**
     * Scope for search functionality.
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function($q) use ($search) {
            $keywords = preg_split('/\s+/', trim($search));
            foreach ($keywords as $word) {
                $q->where(function($q) use ($word) {
                    $q->where('appname', 'like', "%{$word}%")
                      ->orWhere('description', 'like', "%{$word}%")
                      ->orWhere('category', 'like', "%{$word}%");
                });
            }
        });
    }

    // ================================
    // ACCESSORS & MUTATORS
    // ================================

    /**
     * Get the formatted category name.
     */
    public function getFormattedCategoryAttribute(): string
    {
        return ucfirst($this->category);
    }

    /**
     * Get the category icon data.
     */
    public function getCategoryIconAttribute(): array
    {
        $icons = [
            'akademik' => [
                'icon' => 'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z',
                'color' => 'from-blue-500 to-blue-600',
                'emoji' => '🎓',
                'bg_color' => 'bg-blue-100 text-blue-800'
            ],
            'pegawai' => [
                'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                'color' => 'from-green-500 to-green-600',
                'emoji' => '👥',
                'bg_color' => 'bg-green-100 text-green-800'
            ],
            'pembelajaran' => [
                'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                'color' => 'from-orange-500 to-orange-600',
                'emoji' => '📖',
                'bg_color' => 'bg-orange-100 text-orange-800'
            ],
            'administrasi' => [
                'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                'color' => 'from-purple-500 to-purple-600',
                'emoji' => '📋',
                'bg_color' => 'bg-purple-100 text-purple-800'
            ]
        ];
        
        return $icons[$this->category] ?? $icons['administrasi'];
    }

    /**
     * Get the status badge color.
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'published' => 'bg-green-100 text-green-800',
            'draft' => 'bg-yellow-100 text-yellow-800',
            'archived' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Get truncated description.
     */
    public function getTruncatedDescriptionAttribute(): string
    {
        return \Str::limit($this->description, 100);
    }

    /**
     * Check if application has a valid link.
     */
    public function getHasLinkAttribute(): bool
    {
        return !empty($this->applink) && filter_var($this->applink, FILTER_VALIDATE_URL);
    }

    /**
     * Get formatted created date.
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->format('d M Y');
    }

    /**
     * Get formatted updated date.
     */
    public function getFormattedUpdatedAtAttribute(): string
    {
        return $this->updated_at->format('d M Y');
    }

    // ================================
    // METHODS
    // ================================

    /**
     * Check if application is published.
     */
    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    /**
     * Check if application is draft.
     */
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    /**
     * Check if application is archived.
     */
    public function isArchived(): bool
    {
        return $this->status === 'archived';
    }

    /**
     * Publish the application.
     */
    public function publish(): bool
    {
        return $this->update(['status' => 'published']);
    }

    /**
     * Set application as draft.
     */
    public function draft(): bool
    {
        return $this->update(['status' => 'draft']);
    }

    /**
     * Archive the application.
     */
    public function archive(): bool
    {
        return $this->update(['status' => 'archived']);
    }

    // ================================
    // STATIC METHODS
    // ================================

    /**
     * Get available categories.
     */
    public static function getCategories(): array
    {
        return [
            'akademik' => 'Akademik',
            'pegawai' => 'Pegawai',
            'pembelajaran' => 'Pembelajaran',
            'administrasi' => 'Administrasi'
        ];
    }

    /**
     * Get available statuses.
     */
    public static function getStatuses(): array
    {
        return [
            'draft' => 'Draft',
            'published' => 'Published',
            'archived' => 'Archived'
        ];
    }

    /**
     * Get published applications for public.
     */
    public static function getPublicApplications()
    {
        return static::published()
                    ->withLink()
                    ->orderBy('category', 'asc')
                    ->orderBy('appname', 'asc');
    }

    // ================================
    // QUERY HELPERS
    // ================================

    /**
     * Get applications by category for public.
     */
    public static function getByCategory(string $category)
    {
        return static::published()
                    ->withLink()
                    ->category($category)
                    ->orderBy('appname', 'asc');
    }

    /**
     * Search applications for public.
     */
    public static function searchPublic(string $search)
    {
        return static::published()
                    ->withLink()
                    ->search($search)
                    ->orderBy('appname', 'asc');
    }
}
